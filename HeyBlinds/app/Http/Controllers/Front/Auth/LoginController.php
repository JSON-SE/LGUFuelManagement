<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateUserDataAfterLogin;
use App\Models\AbandonedCustomer;
use App\Models\Front\Cart\Cart;
use App\Models\Profile;
use App\Models\SampleCart;
use App\Models\User;
use App\Notifications\AfterRegisterNotification;
use App\Notifications\SavedAbandonedCartNotification;
use App\Notifications\VerificationNotification;
use App\Notifications\WelcomeMailNofitication;
use App\Rules\UserLoginEmailExist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class LoginController extends Controller
{
    
    public $getCookieCartId;
    public $getSampleCookieCartId;

    public function __construct()
    {
        $this->getCookieCartId = $_COOKIE['__cart_items'] ?? '';
        $this->getSampleCookieCartId = $_COOKIE['__sb_sample_cart'] ?? '';
    }

    public function login(Request $request)
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $data = [
                'cart_id' => $this->getCookieCartId,
                'sample_cart_id' => $this->getSampleCookieCartId
            ];
           $this->runAfterLogin($data);
        }
        return redirect()->back()->with('message','The provided credentials do not match our records');
    }
    public function saveLogin(Request $request)
    {
        request()->validate([
            'login_email' => ['required',new UserLoginEmailExist()],
            'login_password' => ['required'],
        ],[
            'login_email.required' => 'The email filed is required.',
            'login_password.required' => 'The password field is required.',
        ]);
        $auth = [
            'email' => $request->login_email,
            'password' => $request->login_password,
        ];
        if (Auth::attempt($auth)) {
            $data = [
                'cart_id' => $this->getCookieCartId,
                'sample_cart_id' => $this->getSampleCookieCartId
            ];
            $this->runAfterLogin($data);
            $request->session()->regenerate();
        }
        return redirect()->back();
    }

    public function registration(Request $request)
    {
        
        request()->validate([
            'first_name' => ['required','string','max:30'],
            'last_name' => ['nullable','string','max:30'],
            'email' => ['required','email','unique:users'],
            'confirm_email' =>['required','same:email'],
            'password' => ['required','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            'phone_number' => ['required','min:16'],
        ],[
            'phone_number.min' => 'The phone number is invalid.'
        ]);
        DB::beginTransaction();
        $user = User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->phone_number)),
        ]);
        // cart::where('external_id',  $_COOKIE['__cart_items'])->update([
        //     'user_id' => $user->id,
        //     'cart_draft' => false,
        // ]);
        if ($user) {
        Auth::login($user);
        $data = [
                'cart_id' => $this->getCookieCartId,
                'sample_cart_id' => $this->getSampleCookieCartId
            ];
            $this->runAfterLogin($data);
            //$user->notify(new AfterRegisterNotification());
            $user->notify(new VerificationNotification($this->getCookieCartId));

            DB::commit();
            return redirect()->to('/user/my-cart')->with('message','Successfully Account Created and Cart Saved.');
        }else{
            DB::rollback();
            return redirect()->back()->with('message', 'New User Creation Failed.');
        }
        return redirect()->back()->with('message','Successfully Account Created and Cart Saved.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        \Cookie::forget('__cart_items');
        return response()->json([
            'status' => true,
            'message' => 'Successfully logout',
        ]);
    }

    public function FormCartlogin(Request $request)
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $data = [
                'cart_id' => $this->getCookieCartId,
                'sample_cart_id' => $this->getSampleCookieCartId
            ];
            $this->runAfterLogin($data);

            return response()->json([
                'status' => true,
                'message' => 'Successfully Logged In'
            ]);
        }

        $data = [
            'cart_id' => $this->getCookieCartId,
            'sample_cart_id' => $this->getSampleCookieCartId
        ];
       $this->runAfterLogin($data);

        return response()->json([
            'status' => false,
            'message' => 'The provided credentials do not match our records.'
        ]);

    }

    public function runAfterLogin($data){
        if (!empty($data['cart_id']) && array_key_exists('cart_id', $data) && Auth::check()){
            $user = Auth::user();
            $cart = Cart::where('external_id', $data['cart_id'])->first();
            if (!empty($cart)){
                $cart->user_id = Auth::id();
                $cart->cart_draft = true;
                $cart->save();
            }
            $this->storeActionReport($cart->id);
            //Notification::route('mail',['robert@heyblinds.ca','satya@klizos.com'])->notify(new SavedAbandonedCartNotification($user,$cart));
        }elseif (!empty($data['sample_cart_id']) && array_key_exists('sample_cart_id', $data) && Auth::check()){
            $sampleCarts = SampleCart::where('external_id', $data['sample_cart_id'])->get();
            foreach ($sampleCarts as $sampleCart){
                if (!empty($sampleCart)){
                    $sampleCart->user_id = Auth::id();
                    $sampleCart->save();
                }
            }
        }

    }
     public function storeActionReport($id)
    {
        AbandonedCustomer::updateOrCreate(
            [
                'cart_id' => $id,
            ],
            [
                'cart_id' => $id,
                'cart_type' => 1,
                'shipping_first_name' => auth()->user()->first_name ?? '',
                'shipping_last_name' => auth()->user()->last_name ?? '',
                'shipping_email' => auth()->user()->email ?? '',
                'shipping_phone_number' => auth()->user()->profile->phone_number ?? '',
                'billing_province' => auth()->user()->profile->province ?? '',
            ]
        );
    }
    
}
