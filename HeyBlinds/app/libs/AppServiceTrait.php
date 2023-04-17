<?php

namespace App\libs;

use Carbon\Carbon;
use App\Models\Review;
use App\Helpers\Helpers;
use App\Models\SampleCart;
use App\Models\Admin\Filter;
use App\Models\Admin\Cart\Cart;
use App\Models\Admin\Promo\Promo;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Category\Category;
use App\Models\Admin\Category\SubCategory;

trait AppServiceTrait
{

    public function service()
    {
        $getCookieCartId     = $_COOKIE['__sb_sample_cart'] ?? '';
        $getCookieReadCartId = $_COOKIE['__cart_items'] ?? '';
        $data                = [];
        $cartCount           = 0;
        $sampleCount         = 0;
        if (!empty($getCookieCartId)) {
            $sampleCount = DB::table('sample_carts',)->where('external_id', $getCookieCartId)->count();
        }

        if (!empty($getCookieReadCartId)) {
            $cartId = DB::table('carts')->where('external_id', $getCookieReadCartId)->pluck('id')->first();
            if (!empty($cartId)) {
                $cartCount = DB::table('cart_items')->where('cart_id', $cartId)->sum('quantity');
            }
        }

        $data = [
            'cart_id'        => $getCookieReadCartId,
            'sample_cart_id' => $getCookieCartId,
        ];

        if (!empty($data['cart_id'])  && Auth::check()) {
            $cart = Cart::where('external_id', $data['cart_id'])->first();
            if (!empty($cart)) {
                $cart->user_id = Auth::id();
                $cart->save();
            }
        } elseif (!empty($data['sample_cart_id'])  && Auth::check()) {
            $sampleCarts = SampleCart::where('external_id', $data['sample_cart_id'])->get();
            foreach ($sampleCarts as $sampleCart) {
                if (!empty($sampleCart)) {
                    $sampleCart->user_id = Auth::id();
                    $sampleCart->save();
                }
            }
        }

        //  $date   = now();
        $coupon = DB::table('coupons')->where('is_active', true)
            ->whereRaw('start_date <=  now()')
            ->whereRaw('end_date >=  now()')
            ->first() ?? null;

        // dd($coupon);
        View::share('headerCoupon', $coupon);
        View::share('sampleCount', $sampleCount);
        View::share('cartCount', $cartCount);
        View::share('getCookieReadCartId', $getCookieReadCartId);

        $categories = Category::limit(6)->where('is_active', 1)->orderBy('order_by', 'asc')
            ->with('subCategories', function ($query) {
                $query->orderBy('order_by', 'asc');
            })
            ->with('superCategories', function ($query) {
                $query->with('subcategories', function ($q) {
                    $q->orderBy('order_by', 'asc');
                });
            })
            ->get();

        $subCategories = SubCategory::whereHas('product', function ($query) {
            $query->where('is_live', 1)
                ->where('draft', 0)
                ->where('display_media_id', '!=', null)
                ->whereHas('price')
                ->whereHas('options');
        })->orderBy('order_by', 'asc')->get();

        $helper   = new Helpers;


        $productFlitersRooms   = Filter::where('status', 1)->whereHas('haveProducFtilter')->where('type', 1)->get();
        $productFlitersFeatures = Filter::where('status', 1)->whereHas('haveProducFtilter')->where('type', 2)->get();

        //Paginator::useBootstrap();

        $promo = Promo::where('is_active', true)->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now())->orderBy('created_at', 'desc')->first();
        $reviewsCount = Review::where('status', 1)->orderByDesc('updated_at')->count();
        $avgOfReviews = Review::where('status', 1)->avg('rating_point');

        View::share('categories', $categories);
        View::share('subCategories', $subCategories);
        View::share('productFlitersRooms', $productFlitersRooms);
        View::share('productFlitersFeatures', $productFlitersFeatures);
        View::share('helpers', $helper);
        View::share('promo', $promo);
        View::share('reviewsCount', $reviewsCount);
        View::share('avgOfReviews', $avgOfReviews);
    }
}
