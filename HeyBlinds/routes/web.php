<?php
date_default_timezone_set('Canada/Eastern');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcriberController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\GlobalAjaxController;
use App\Http\Controllers\Front\SampleController;
use App\Http\Controllers\PremiumPlainConrtoller;
use App\Http\Controllers\Front\InvoiceController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\BlackoutProductController;
use App\Http\Controllers\Front\Auth\LoginController;
use App\Http\Controllers\Front\FrontProductController;
use App\Http\Controllers\Front\SampleCheckoutController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


//use Spatie\Sitemap\SitemapGenerator;

// Route::get('/sitemap',function(){
//    // return "hello";
//   // SitemapGenerator::create('https://staging.heyblinds.ca')->writeToFile(public_path('sitemap.xml'));

//     //SitemapGenerator::create('https://heyblinds.ca/')->writeToFile(public_path('sitemap.xml'));
//      return "File generate successfully.";

// });



Route::get('/details', function () {
    return view('emails.order-confirmation');
});
Route::get('/demo-database', [DemoController::class, 'mergeTable']);
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::post('/media/upload', [GlobalAjaxController::class, 'upload'])->name('upload.media');
Route::post('/global/sort', [GlobalAjaxController::class, 'sort'])->name('global.sort');
Route::post('/sort/product-slide-image', [GlobalAjaxController::class, 'sortProductSlideImage'])->name('sort.product.slide.image');

Route::get('/Frontline-Worker-Special-Discount', [HomeController::class, 'specialDiscount']);

Route::get('/cart', [CartController::class, 'index'])->name('cart'); // displaying the cart page
// Route::get('/checkout', [CartController::class, 'checkOut']);   // moving to checkout page
Route::post('/place-order', [CheckoutController::class, 'order'])->name('place.order'); // saving the order details.
Route::post('/postal/code', [CheckoutController::class, 'postalCode'])->name('place.postal.code');
Route::post('/google-review-status', [CheckoutController::class, 'googleReviwStaus']);

Route::post('/tax-calculation', [CheckoutController::class, 'taxCalculation'])->name('tax.calculation'); // this is for tax calcuation based on provience.
Route::post('/subcriber/email', [SubcriberController::class, 'store'])->name('subcriber.email');
Route::post('/subcriber/email/check', [SubcriberController::class, 'getInfo'])->name('subcriber.getInfo');
Route::post('/unsubscribe/email', [SubcriberController::class, 'unsubscribe'])->name('subcriber.unsubscribe');


Route::get('/save-cart/{id}', [CartController::class, 'saveCart'])->name('save.cart'); // saving the cart page moving.
Route::get('/demo-email', [DemoController::class, 'demoEmail']);
Route::post('/demo-email', [DemoController::class, 'store']);

Route::post('/user/login', [LoginController::class, 'login'])->name('user.login'); // checkout page login process
Route::post('/user/form-cart-login', [LoginController::class, 'FormCartlogin'])->name('user.cart.login');

Route::post('/user/logout', [LoginController::class, 'logout'])->name('user.logout'); // checkout page login process
Route::post('/user/save-login', [LoginController::class, 'saveLogin'])->name('user.save.login'); // checkout page login process
Route::post('/user/registration', [LoginController::class, 'registration'])->name('user.registration');
Route::post('/user/new-registration', [LoginController::class, 'newRegistration'])->name('user.new.registration'); // checkout page login process

Route::name('frontend.')->group(function () {

    Route::post('/save-cart/{id}/store', [CartController::class, 'saveCartStore'])->name('save.cart.store'); // saving the cart page moving.
    Route::post('/save-cart/{id}/update', [CartController::class, 'updateCartStore'])->name('save.cart.update'); // saving the cart page moving.
    Route::post('/save-cart/destroy', [CartController::class, 'destroyCart'])->name('save.cart.destroy'); // saving the cart page moving.
    Route::post('/cart/clone', [CartController::class, 'clone'])->name('save.cart.clone'); // saving the cart page moving.
    Route::get('/category/{slug}/filter', [CategoryController::class, 'category_filter'])->name('categoryFilter');
    Route::get('/category/{slug}/{sub_category_slug}/filter', [CategoryController::class, 'category_filter'])->name('categoryFilter.subcategory');
    Route::get('/category/{slug}', [CategoryController::class, 'view'])->name('category');
    Route::get('/category/{category_slug}/{sub_category_slug}', [CategoryController::class, 'view'])->name('category.sub-category');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.without.id');
    Route::get('/cart/{external_id}', [CartController::class, 'view'])->name('cart')->middleware('prevent-back-history');
    Route::get('/checkout/{external_id}', [CartController::class, 'checkOut'])->middleware('prevent-back-history')->name('checkout');
    Route::post('/review/order', [CartController::class, 'review'])->name('review.order');

    Route::post('/cart/items/update/{item_id}', [CartController::class, 'update'])->name('cart.item.update'); // it is updating the note, room name, quanity route.
    Route::delete('/cart/{item_id}', [CartController::class, 'destroy'])->name('destroy'); // it is delete the order entry item.
    Route::post('/apply-coupon/{cart_id}/apply', [CartController::class, 'applyCoupon'])->name('applyCoupon'); // it is for applying coupon
    Route::post('/remove-coupon/{cart_id}/remove', [CartController::class, 'removeCoupon'])->name('removeCoupon'); // it is for applying coupon
    Route::get('/product/{slug}', [FrontProductController::class, 'view'])->name('product.details');
    Route::get('/product-new/{slug}', [ProductController::class, 'show'])->name('product.show');
    // Route::post('/product/file/instruction-download/{slug}', [FrontProductController::class, 'downlodPdf'])->name('product.downlodPdf');

    Route::get('/product/{slug}/edit/{cartId}/{itemId}', [FrontProductController::class, 'view'])->name('edit.product.details');

    Route::post('/product/save/{id}/checkout/data', [CartController::class, 'saveCheckout'])->name('save.checkout');
    Route::post('/{id}/product-get-price', [FrontProductController::class, 'price'])->name('product.get.price');
    Route::post('/product/{id}/store', [FrontProductController::class, 'store'])->name('product.store');
    Route::post('/product/ample-add-to-cart', [FrontProductController::class, 'addToSampleCart'])->name('product.add.to.sample');
    Route::post('/product/{id}/sample-remove-from-cart', [FrontProductController::class, 'removeSampleCart'])->name('product.remove.from.sample');

    Route::get('/blackout-product', [BlackoutProductController::class, 'index'])->name('blackout.index');
    Route::post('/blackout/product/search', [BlackoutProductController::class, 'search'])->name('blackout.product.search');



    Route::get('/sample/checkout/{id}', [SampleCheckoutController::class, 'view'])->middleware('prevent-back-history')->name('sample.checkout.index');
    // Route::post('/sample/checkout/auto/{id}/{externalId}', [SampleCheckoutController::class, 'customerData'])->name('sample.checkout.store.customer.data');
    //Route::get('/sample/checkout/', [SampleCheckoutController::class, 'index'])->name('sample.checkout.view');
    Route::post('/sample/{id}/checkout', [SampleCheckoutController::class, 'store'])->name('sample.checkout.store');
    Route::post('/sample/{id}/view', [SampleCheckoutController::class, 'allCart'])->name('sample.checkout.all.view');
    Route::get('/sample/thank-you/{id}', [SampleCheckoutController::class, 'thankYou'])->middleware('prevent-back-history')->name('sample.thank.you');

    Route::get('/invoice/download/{id}', [InvoiceController::class, 'invoiceDownload'])->name('invoice.download');
    Route::get('/invoice/send-invoice-email/{id}', [InvoiceController::class, 'sendInvoiceInEmail'])->name('invoice.email');

    Route::post('category-search', [CategoryController::class, 'search'])->name('category.search');

    Route::get('/thank-you/{id}', [CheckoutController::class, 'thankYou'])->name('thank.you');
    Route::get('/measure-guide', [HomeController::class, 'measureGuide'])->name('measure.guide');

    //for  pages
    Route::get('/warranty', [HomeController::class, 'warranty'])->name('warranty');
    Route::get('/about-us', [HomeController::class, 'about'])->name('about');
    Route::get('/measure-instructions', [HomeController::class, 'measure_instructions'])->name('measure_instructions');
    Route::get('/free-shipping', [HomeController::class, 'free_shipping'])->name('free_shipping');
    Route::get('/terms-and-conditions', [HomeController::class, 'termConditions'])->name('term.conditions');
    Route::get('/faq', [HomeController::class, 'showFaqPage'])->name('faq');

    Route::resource('/review', '\App\Http\Controllers\ReviewController');
    Route::get('/reviews-of-HeyBlinds', '\App\Http\Controllers\ReviewController@showReviewsPage');

    Route::post('/product-form-review', '\App\Http\Controllers\ReviewController@productReview');
    Route::get('/customize-premium-plain', [PremiumPlainConrtoller::class, 'index'])->name('premium.plain.index');

    Route::get('/samples', [SampleController::class, 'index'])->name('sample.index');
    Route::post('/samples/show', [SampleController::class, 'show'])->name('show.sample.product.data');
    //for contact page
    Route::get('/contact-us', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact-us', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

    Route::post('/alert-for-saved-abandoned-cart/{external_id}', [GlobalAjaxController::class, 'SavedAbandonedCart']);

    //for order tranking
    //Route::get('/order-tracking', [App\Http\Controllers\OrderTrackingController::class, 'index'])->name('tracking.index');
    Route::post('/order-tracking', [App\Http\Controllers\OrderTrackingController::class, 'checkOrderStatus'])->name('tracking.check');
    Route::get('/shop/{slug}', [App\Http\Controllers\Front\ShopController::class, 'show'])->name('shop.show');
    Route::post('/shop/search', [App\Http\Controllers\Front\ShopController::class, 'search'])->name('shop.search');
    Route::resource('/blog', '\App\Http\Controllers\BlogController');
    Route::post('/blog/search', '\App\Http\Controllers\BlogController@search');
    Route::get('/blog/category/{slug}', '\App\Http\Controllers\BlogController@index');

    Route::resource('/comment', '\App\Http\Controllers\CommentController');
    Route::resource('/reply', '\App\Http\Controllers\Replycontroller');
    Route::post('/rembermber-size-of-measure-store', '\App\Http\Controllers\GlobalAjaxController@remberMeasure');
    Route::post('/rembermber-size-of-measure', '\App\Http\Controllers\GlobalAjaxController@remberMeasureRetrive');
});

Route::name('user.')
    ->group(function () {
        Route::get('/user/my-order', [App\Http\Controllers\UserController::class, 'index'])->name('home');
        Route::get('/user/cart/{id}/details', [App\Http\Controllers\UserController::class, 'cartPageShow'])->name('cart.details');
        Route::get('/user/my-account', [App\Http\Controllers\UserController::class, 'account'])->name('account');
        Route::get('/user/my-cart', [App\Http\Controllers\UserController::class, 'cart'])->name('cart');
        Route::post('/user/my-account/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('account.update');
        Route::post('/user/change-password', [App\Http\Controllers\UserController::class, 'update'])->name('change.password');
    });

// email verification and rest functionality
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('reset-password', [App\Http\Controllers\Front\Auth\ReestPasswordController::class, 'store'])->name('password.update');

Route::get('/email/verify/{cart_id}/{id}/{hash}', [App\Http\Controllers\Front\Auth\EmailVerifyController::class, 'verifyEmail'])
    ->middleware('signed')->name('verification.verify');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Front\Auth\EmailVerifyController::class, 'verifyEmail'])
    ->middleware('signed')->name('verification.verify.registration');

// Route::post('/email/verification-notification', [App\Http\Controllers\Front\Auth\EmailVerifyController::class, 'sendVerifyLink'])
//     ->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// account setting
