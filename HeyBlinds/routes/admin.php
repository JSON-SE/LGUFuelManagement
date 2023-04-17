<?php
date_default_timezone_set('Canada/Eastern');

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Ordercontroller;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HeadrailController;
use App\Http\Controllers\Admin\AbandonedController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\Product\OptionController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\SuperSubCategoryController;
use App\Http\Controllers\Admin\AdditionalSettingsController;
use App\Http\Controllers\Admin\User\UserManagementController;

Route::prefix('admin')->namespace('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->middleware('guest:admin')->group(function () {
        //login route
        Route::get('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/login/submit', [LoginController::class, 'processLogin'])->name('login.submit');
    });
    Route::namespace('Auth')->middleware('auth:admin')->group(function () {
        Route::post('/logout', function () {
            Auth::guard('admin')->logout();
            return redirect()->action([LoginController::class, 'login']);
        })->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/media/destroy/{id}', [DashboardController::class, 'removeMedia']);
        Route::resource('/coupons', '\App\Http\Controllers\Admin\CouponController');
        // Route::resource('/coupon', '\App\Http\Controllers\Admin\CouponController');
        Route::resource('/modal-coupons', '\App\Http\Controllers\Admin\SubcriberCouponController');
        Route::resource('/promo', '\App\Http\Controllers\Admin\PromoController');
        Route::post('/promo/extra-field-remove', [PromoController::class, 'extra_field_destroy']);
        Route::resource('/order', '\App\Http\Controllers\Admin\Ordercontroller');
        Route::post('/order-info', '\App\Http\Controllers\Admin\Ordercontroller@showOrderInfo');

        Route::post('/multiple-subcategory-product-info', '\App\Http\Controllers\Admin\MultiplePromoController@findProduct');


        Route::post('/shipping-info-edit', '\App\Http\Controllers\Admin\ShippingAddressController@update');
        Route::post('/billing-info-edit', '\App\Http\Controllers\Admin\BillingAddressController@update');
        Route::get('/subcriber', '\App\Http\Controllers\Admin\SubcriberController@index')->name('subcriber.index');
        Route::get('/subcariber/subcariber-export', '\App\Http\Controllers\Admin\SubcriberController@export');
        Route::get('/contact', '\App\Http\Controllers\Admin\ContactController@index')->name('contact');
        Route::get('/klaviya-info', '\App\Http\Controllers\Admin\KlaviyaController@index')->name('klaviya.index');
        Route::get('/klaviya-info/{id}', '\App\Http\Controllers\Admin\KlaviyaController@show')->name('klaviya.show');
        Route::post('/blog/status/{id}', '\App\Http\Controllers\Admin\BlogController@updateStatus');
        Route::post('/blog/{id}', '\App\Http\Controllers\Admin\BlogController@update');
        Route::resource('/blog', '\App\Http\Controllers\Admin\BlogController');

        Route::post('/blog/image/upload', '\App\Http\Controllers\Admin\BlogController@imageUpload');

        Route::resource('/blog-category', '\App\Http\Controllers\Admin\BlogCategoryController');

        Route::post('/blog/comment/status/{id}', '\App\Http\Controllers\Admin\CommentController@updateStatus');
        Route::resource('/blog/{id}/comment', '\App\Http\Controllers\Admin\CommentController');

        Route::post('/blog/comment/reply/status/{id}', '\App\Http\Controllers\Admin\ReplyController@updateStatus');

        // Route::post('/blog/comment/reply/update/{id}', '\App\Http\Controllers\Admin\ReplyController@update');
        Route::resource('/comment/{id}/reply', '\App\Http\Controllers\Admin\ReplyController');



        Route::get('/action', [AbandonedController::class, 'index'])->name('abandoned.cart');
        Route::post('/action', [AbandonedController::class, 'show'])->name('abandoned.show');
        Route::get('/saved-cart', [AbandonedController::class, 'savedCart'])->name('saved.cart');
        Route::post('/saved-cart', [AbandonedController::class, 'savedCartShow'])->name('saved.cart.show');
        Route::get('/abandoned/cart-export', [AbandonedController::class, 'exportAbadone'])->name('abandoned.cart.export');
        Route::get('/manually', [AbandonedController::class, 'manually']);


        Route::post('/note', '\App\Http\Controllers\Admin\Ordercontroller@note');
        Route::post('/change-order-status', '\App\Http\Controllers\Admin\Ordercontroller@changeOrderStatus');
        Route::post('/delete-order-entry', '\App\Http\Controllers\Admin\Ordercontroller@deleteOrderEntry');
        Route::post('/update-order-entry', '\App\Http\Controllers\Admin\Ordercontroller@updateOrderEntry');
        Route::get('/order-search', '\App\Http\Controllers\Admin\Ordercontroller@orderSearch');
        Route::get('/order-export', '\App\Http\Controllers\Admin\Ordercontroller@export');

        Route::resource('/samples', '\App\Http\Controllers\Admin\SampleOrderController');
        Route::post('/samples-order-info', '\App\Http\Controllers\Admin\SampleOrderController@orderInfo');
        Route::post('/sample-note', '\App\Http\Controllers\Admin\SampleOrderController@note');
        Route::post('/change-sample-order-status', '\App\Http\Controllers\Admin\SampleOrderController@changeOrderStatus');
        Route::post('/change-sample-order-shipping-method', '\App\Http\Controllers\Admin\SampleOrderController@changeShippingMethod');
        Route::post('/change-sample-order-shipping-date', '\App\Http\Controllers\Admin\SampleOrderController@changeShippingDate');
        Route::post('/change-sample-order-shipping-tracking', '\App\Http\Controllers\Admin\SampleOrderController@changeShippingTrackingNumber');
        // Route::post('/delete-order-entry','\App\Http\Controllers\Admin\Ordercontroller@deleteOrderEntry');
        Route::get('/sample-order', '\App\Http\Controllers\Admin\SampleOrderController@index');
        Route::get('/sample-order-export/', '\App\Http\Controllers\Admin\SampleOrderController@export');

        //Category Route
        Route::get('category/show-subcatory/{id}/category', '\App\Http\Controllers\Admin\CategoryController@showSubcategory')->name('category.show.subcategory');
        Route::resource('category', '\App\Http\Controllers\Admin\CategoryController');
        Route::post('category/menu-active', '\App\Http\Controllers\Admin\CategoryController@categoryMenuActive')->name('category.menu.active');

        Route::resource('super-subcategory', '\App\Http\Controllers\Admin\SuperSubCategoryController');


        Route::get('sub-category', [SubCategoryController::class, 'index'])->name('sub.category.index');
        Route::get('sub-category/create', [SubCategoryController::class, 'create'])->name('sub.category.create');
        Route::post('sub-category/store', [SubCategoryController::class, 'store'])->name('sub.category.store');
        Route::get('sub-category/{slug}/edit', [SubCategoryController::class, 'edit'])->name('sub.category.edit');
        Route::post('sub-category/{slug}/update', [SubCategoryController::class, 'update'])->name('new.sub.category.update');
        Route::delete('sub-category/{slug}/destroy', [SubCategoryController::class, 'destroy'])->name('sub.category.destroy');
        Route::post('super_subcategory_id', [SubCategoryController::class, 'selectSubCategoryList'])->name('sub.category.list');

        Route::resource('product', '\App\Http\Controllers\Admin\Product\ProductController');
        Route::post('product-search', '\App\Http\Controllers\Admin\Product\ProductController@productSearch');
        Route::post('product/price', [ProductController::class, 'price'])->name('product.price.store');
        Route::post('product/name/store', [ProductController::class, 'store'])->name('product.name.store');
        Route::post('product/get/sub-category', [ProductController::class, 'getSubCategory'])->name('product.get.sub.category');
        Route::post('product/get/colors', [ProductController::class, 'getColors'])->name('product.get.colors');
        Route::post('product/tooltip/update', [ProductController::class, 'tooltips'])->name('product.tooltips');
        Route::post('product/store/colors', [ProductController::class, 'storeColors'])->name('product.store.colors');
        Route::delete('product/destroy/colors', [ProductController::class, 'destroyColors'])->name('product.destroy.colors');
        Route::post('product/{id}/update', [ProductController::class, 'update'])->name('product.update.new');
        Route::post('product/{id}/inset-or-update/option', [ProductController::class, 'option'])->name('main.product.option.store');
        Route::post('product/home-media-form', [ProductController::class, 'homeMediaForm'])->name('main.product.media.form');
        Route::delete('product/inset-or-update/option/remove', [ProductController::class, 'optionRemove'])->name('main.product.option.remove');
        Route::post('product/{id}/inset-or-update/price', [ProductController::class, 'storePrice'])->name('main.product.price.store');
        Route::post('product/{id}/inset-or-update/price/single', [ProductController::class, 'updateSinglePrice'])->name('main.product.price.single.update');
        Route::post('product/show-home-page', [ProductController::class, 'showHomePageStatus']);
        Route::post('product/{id}/inset-or-update/measure', [ProductController::class, 'measure'])->name('main.product.measure.store');
        Route::post('product/{id}/inset-or-update/shipping', [ProductController::class, 'shipping'])->name('main.product.shipping.store');
        Route::delete('product/inset-or-update/remove/image', [ProductController::class, 'removeMedia'])->name('main.product.remove.media');
        Route::post('product/color/update-percentage', [ProductController::class, 'updatePercentage'])->name('main.product.color.update.percentage');
        Route::post('product/product-headreail', [HeadrailController::class, 'headreailStore'])->name('product.headrail.store');
        Route::delete('/product/product-headreail-delete/{id}', [HeadrailController::class, 'delete'])->name('product.headrail.delete');
        Route::post('/product/headrail-left-side/{id}', [HeadrailController::class, 'headrailLeftStatus']);
        Route::post('/product/headrail-right-side/{id}', [HeadrailController::class, 'headrailRightStatus']);
        Route::post('/separate-blinds/{id}', [HeadrailController::class, 'SeparateBlinds']);
        Route::post('/headrail-status/{id}', [HeadrailController::class, 'headrailSatus']);
        //Route::resource('/extra-setting-shipping-price','\App\Http\Controllers\Admin\ShippingController');
        //Route::resource('/extra-setting-shipping-price','\App\Http\Controllers\Admin\ShippingController');
        Route::get('/extra-setting', '\App\Http\Controllers\Admin\ExtraPriceController@index')->name('extra-setting.index');
        Route::post('/extra-setting-shipping-price', '\App\Http\Controllers\Admin\ExtraPriceController@shippingPriceStore');
        Route::post('/extra-setting-handling-price', '\App\Http\Controllers\Admin\ExtraPriceController@shippingHandlingStore');
        Route::post('/extra-setting-handling-price', '\App\Http\Controllers\Admin\ExtraPriceController@shippingHandlingStore');

        Route::post('media/measure/delete', [ProductController::class, 'removeMeasureMedia']);

        Route::resource('product-option', '\App\Http\Controllers\Admin\Product\OptionController')->names('product.option');
        Route::post('option-search', '\App\Http\Controllers\Admin\Product\OptionController@optionSearch');
        Route::delete('product-option/price/remove', [OptionController::class, 'RemovePrice'])->name('product.option.price.remove');
        Route::resource('product-option-group', '\App\Http\Controllers\Admin\Product\OptionGroupController')->names('product.option.group');
        Route::post('color-upload-csv', '\App\Http\Controllers\Admin\ColorController@storeCsvFile')->name('color.store.csv');
        Route::get('/color/color-export', '\App\Http\Controllers\Admin\ColorController@export');
        Route::resource('color', '\App\Http\Controllers\Admin\ColorController');
        Route::post('/checked-color-update', '\App\Http\Controllers\Admin\ColorController@checkedUpdate');
        Route::put('/color/checked/{id}', '\App\Http\Controllers\Admin\ColorController@checkedUpdateOne');




        Route::resource('color-group', '\App\Http\Controllers\Admin\ColorGroupController')->names('color.group');

        Route::post('product/filter/assign', '\App\Http\Controllers\Admin\Product\ProductFilterController@assign')->name('filter.assign');



        //All SEO Route

        Route::post('product/seo/inset-or-update', [ProductController::class, 'seo'])->name('main.product.seo.store');
        Route::post('category/seo/inset-or-update', [CategoryController::class, 'seo'])->name('main.category.seo.store');
        Route::post('sub-category/seo/inset-or-update', [SubCategoryController::class, 'seo'])->name('main.sub-category.seo.store');

        //Customers
        Route::resource('/customers', '\App\Http\Controllers\Admin\CustomerController');
        Route::get('/review-of-website', '\App\Http\Controllers\Admin\ReviewController@websiteReview')->name('review.web');
        Route::post('/review-of-website', '\App\Http\Controllers\Admin\ReviewController@websiteReviewShow');
        Route::post('/review-of-website-update/{id}', '\App\Http\Controllers\Admin\ReviewController@websiteUpdate')->name('website.review.update');
        Route::post('/review-of-product-update/{id}', '\App\Http\Controllers\Admin\ReviewController@productUpdate')->name('product.review.update');
        Route::get('/review-of-product', '\App\Http\Controllers\Admin\ReviewController@productReview')->name('review.product');
        ;
        Route::post('/review-of-product', '\App\Http\Controllers\Admin\ReviewController@productReviewShow');
        Route::post('/review/status-active', '\App\Http\Controllers\Admin\ReviewController@reviewSatusActive');
        Route::post('/review/show-home-page', '\App\Http\Controllers\Admin\ReviewController@reviewSatusActiveHomePage');
        Route::get('/review/{id}/show', '\App\Http\Controllers\Admin\ReviewController@show')->name('review.show');
        Route::delete('/review/delete/{id}', '\App\Http\Controllers\Admin\ReviewController@webReviewDelete')->name('web.review.delete');
        Route::delete('/review/product/delete/{id}', '\App\Http\Controllers\Admin\ReviewController@productReviewDelete')->name('product.review.delete');

        Route::get('product-review/{id}/show', '\App\Http\Controllers\Admin\ReviewController@productShow')->name('review.product.show');
        Route::post('product-review/show-home-page', '\App\Http\Controllers\Admin\ReviewController@reviewStatusProductReview');


        //Users
        Route::get('/users', [UserManagementController::class, 'index'])->name('user.management');

        //Additional Settings
        Route::get('/setup', [AdditionalSettingsController::class, 'create'])->name('additional.settings');

        Route::post('/setup/product-additional-settings', [AdditionalSettingsController::class, 'product'])->name('product.additional.settings.store');

        Route::get('/admin-account-setting', [SettingController::class, 'index'])->name('account.setting');
        Route::post('/admin-account-update', [SettingController::class, 'update'])->name('account.update');
    });
});
