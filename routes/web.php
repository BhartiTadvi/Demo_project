<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin/login', function () {
    return view('login');
    })->name('admin.login');

  
Route::get('/product_attribute', 'ProductAttributeController@create')->name('product_attribute');
Route::post('/attribute/store','ProductAttributeController@store')->name('store_attribute');

Route::get('/subcategory', 'SubcategoryController@create')->name('create.subcategory');
Route::post('/subcategory/store','SubcategoryController@store')->name('store_subcategory');
Route::post('/category','CategoryController@formAction');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('Roles','RoleController');
    Route::resource('Users','UserController');
    
});
//admin routes
Route::resource('banners', 'BannerController');
Route::resource('category', 'CategoryController');
Route::resource('posttable', 'PosttableController');
Route::resource('products', 'ProductsController');
Route::get('/get/subcategories','CategoryController@getSubCategory')->name('getSubCategory');
Route::resource('admin/posts', 'Admin\\PostsController');
Route::resource('coupon/coupon', 'Coupon\\CouponController');

 //frontend routes
 Route::get('/','Frontend\FrontendController@index')->name('home_shopper');
 Route::get('/login','Frontend\RegistrationController@create')->name('login');
 Route::post('/register/store','Frontend\RegistrationController@store')->name('user.store');
 Route::post('/userlogin','Frontend\LoginController@login')->name('userlogin');
 Route::post('/logoutuser','Frontend\LoginController@logout')->name('logoutuser');
 Route::get('/contactus','Frontend\FrontendController@contact')->name('contactus');

 Route::get('/productsinfo/{id}','Frontend\FrontendController@showProduct')->name('product.show');
 Route::get('/pricefilter', 
      ['as' => 'price.filter',
      'uses' => 'Frontend\FrontendController@filterPrice']);
 Route::post('/contact-store','Frontend\FrontendController@storeContact')->name('contact.store');
 Route::get('/productdetails/{id}','Frontend\FrontendController@productDetails')->name('product.details');
Route::get('/productscateory/','Frontend\FrontendController@productCategory');
Route::get('/get/states/','Frontend\AddressController@getState')->name('getState');

// Route::post('/checkout','Frontend\CheckoutController@index')->name('create.checkout');

//cart route
Route::get('/cart', 'Frontend\CartController@index')->name('cart');
Route::get('/shopping-cart-add/{id}', 'Frontend\CartController@addItem')->name('add.cart'); 
Route::get('cart/remove/{id}', 'Frontend\CartController@removeItem')->name('cart.remove');

Route::post('/cartincrementitem/','Frontend\CartController@incrementItem')->name('cart.increment');
Route::post('/cartdecrementitem/','Frontend\CartController@decrementItem')->name('cart.decrement');

Route::post('/applycoupon','Frontend\CartController@applyCoupon')->name('coupon');
Route::post('/cancelcoupon','Frontend\CartController@cancelCoupon')->name('cancel.coupon');

 
//checkout
Route::get('/states/','Frontend\CheckoutController@getState')->name('get.state');

Route::get('/checkout','Frontend\CheckoutController@test')->name('checkout.test');
Route::get('/getbillingaddress/','Frontend\CheckoutController@getBillingAddress')->name('getBillingAddress');
Route::get('/getshippingaddress/','Frontend\CheckoutController@getShippingAddress')->name('getshippingAddress');

Route::get('/user/address', function () {
    return view('frontend.address');
    });
 Route::post('/placeorder/store','Frontend\CheckoutController@placeOrder')->name('placeorder.store');

 Route::get('/thanks','Frontend\CheckoutController@cashOnDelivery')->name('cashondelivery');


//Paypal
 Route::get('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'Frontend\AddMoneyController@payWithPaypal',));
 
 Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'Frontend\AddMoneyController@postPaymentWithpaypal',));
 
 Route::get('paypal', array('as' => 'payment.status','uses' => 'Frontend\AddMoneyController@getPaymentStatus',));

//wishlist

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('addToWishList', 'Frontend\FrontendController@wishList')->name('add.wishlist');
Route::get('/WishList', 'Frontend\FrontendController@ViewWishList');
Route::get('/removeWishList/{id}', 'Frontend\FrontendController@removeWishList')->name('remove.wishlist');


//userprofile
Route::get('/profile', 'Frontend\ProfileController@index')->name('profile');
Route::get('/myAccount', 'Frontend\ProfileController@userAccount')->name('user.account');

Route::post('/updateProfile/{id}', 'Frontend\ProfileController@updateProfile')->name('profile.update');

Route::post('/profileChange/{id}', 'Frontend\ProfileController@showUserProfile')->name('change.profile');

Route::get('/trackOrder', 'Frontend\ProfileController@trackOrder')->name('track.order');
Route::get('/order', 'Frontend\ProfileController@getOrder')->name('user.order');
Route::get('/show-order/{id}', 'Frontend\ProfileController@showOrder')->name('show.order');
Route::get('/passwordchange', 'Frontend\ProfileController@showChangePasswordForm')->name('update.password');
Route::post('/updatePassword', 'Frontend\ProfileController@updatePassword')->name('changepassword');
Route::get('/myAddress', 'Frontend\ProfileController@userAddress')->name('myaddress');
Route::post('/orderStatus', 'Frontend\ProfileController@orderStatus')->name('order.status');
Route::get('/getStatus', 'Frontend\ProfileController@getOrderStatus')->name('get.status');


//manage mail
Route::get('manageMailChimp', 'Frontend\MailChimpController@manageMailChimp');
Route::post('subscribe',['as'=>'subscribe','uses'=>'Frontend\MailChimpController@subscribe']);
Route::post('sendCompaign',['as'=>'sendCompaign','uses'=>'Frontend\MailChimpController@sendCompaign']);

Route::get('demo1',function(){

  return  $countries= App\State::where('countryID', 1)
                    ->get();

});

Route::resource('address', 'Frontend\AddressController');

//manage email notification
Route::resource('manage_user_contacts', 'ManageUserContactController');
Route::resource('manage_user_email', 'ManageUserEmailController');

//order management
Route::resource('order_management', 'OrderManagementController');
Route::get('/order-detail/{id}', 'OrderManagementController@orderDetail')->name('show.orderdetail');
Route::get('/edit/order/{id}', 'OrderManagementController@editOrder')->name('edit.order');
Route::post('/update/order/{id}','OrderManagementController@updateOrder')->name('update.order');

Route::resource('cms', 'CmsController');

//reports
Route::resource('report', 'ReportController');
Route::get('report', 'ReportController@index')->name('report.index');
Route::get('/customer-report', 'ReportController@showCustomer')->name('customer.index');


// Route::post('/placeorder/store','Frontend\CheckoutController@placeOrderNew')->name('placeorder.store');

Route::resource('coupon-procedure', 'CouponProcedureController');
Route::resource('permission', 'PermissionController');