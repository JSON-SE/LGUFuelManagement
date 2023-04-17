<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Admin\Order\Order;
use App\Models\Front\Cart\Cart;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->orderBy('updated_at','desc');
             return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('full_name',function($row){
                    return $row->full_name ?? '';
                })
                ->addColumn('phone_number',function($row){
                    return $row->profile->phone_number ?? '';
                })
                 ->addColumn('order_count',function($row){
                    return $row->orders->count() ?? 0;
                })
                  ->addColumn('cart_count',function($row){
                    return $this->checkCartCount($row->cart_id, $row->id);
                })
                  ->addColumn('created_at',function($row){
                    return $row->created_at->format('Y-m-d H:i');
                })
                ->addColumn('action', function ($row) {
                    $btn= ' <a href="' . route('admin.customers.edit',$row['id']).'" class="btn text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg></a>';

                    $btn =  $btn.'<a class="btn" href="' . route('admin.customers.edit',$row['id']).'" ><svg class="bi bi-pencil-square" fill="currentColor" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path><path d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" fill-rule="evenodd"></path></svg></a>';
                            
                            
                        
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.customers.index');
    }
    private function checkCartCount($cart_id,$user_id){
        $has_cart_order = Order::where('user_id',$user_id)->where('cart_id',$cart_id)->exists();
        if($has_cart_order){
            return 0 ;
        }
        return Cart::where('user_id',$user_id)->count();  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrfail($id);
        return view('admin.customers.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('admin.customers.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request->all();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone_number' => 'nullable|min:16',

        ]);
        $user = User::findOrfail($id);
        //return $request->email_verified_at;
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);
        if($request->email_verified_at == 1){
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        }
        else{
            $user->forceFill(['email_verified_at' => null]);
            $user->save();
           // $user->update(['email_verified_at' => null]);
        }
        $profile = Profile::where('user_id',$id)->updateOrCreate(
            [
                'user_id' => $id,
            ],[
            'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->phone_number)),
            'user_id' => $id,
        ]);
        if($request->password){
            $user->update(['password' => Hash::make($request->password)]);
        }
      
        return redirect('/admin/customers')->with('message','User details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
