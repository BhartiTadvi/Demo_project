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
Route::get('/', function () {
    return view('login');
    });

  
Route::get('/product_attribute', 'Product_attributeController@create')->name('product_attribute');
Route::post('/attribute/store','Product_attributeController@store')->name('store_attribute');

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
Route::resource('admin/posts', 'Admin\\PostsController');
Route::resource('banners', 'BannersController');
Route::resource('category', 'CategoryController');
Route::resource('posttable', 'PosttableController');
Route::resource('products', 'ProductsController');
Route::resource('product_image', 'Product_imageController');
Route::get('/get/subcategories','CategoryController@getSubCategory')->name('getSubCategory');
Route::resource('admin/posts', 'Admin\\PostsController');
Route::resource('coupon/coupon', 'Coupon\\CouponController');

 //frontend routes
 Route::get('/index','Frontend\FrontendController@index')->name('home_shopper');
 Route::get('/loginuser','Frontend\RegistrationController@create')->name('loginuser');
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
Route::get('/get/states/','Frontend\addressController@getState')->name('getState');


//cart route
Route::get('/cart', 'Frontend\CartController@index')->name('cart');
Route::get('/shopping-cart-add/{id}', 'Frontend\CartController@addItem')->name('add.cart'); 
Route::get('cart/remove/{id}', 'Frontend\CartController@removeItem');

Route::post('/cartincrementitem/','Frontend\CartController@incrementItem');
Route::post('/cartdecrementitem/','Frontend\CartController@decrementItem');

Route::get('/applycoupon','Frontend\CartController@applyCoupon');


 
//checkout
Route::get('/checkout','Frontend\CheckoutController@index')->name('create.checkout');
Route::get('/states/','Frontend\CheckoutController@getState')->name('get.state');

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

//Route::get('/logout', 'Auth\LoginController@logout');
Route::post('addToWishList', 'Frontend\FrontendController@wishList');
Route::get('/WishList', 'Frontend\FrontendController@View_wishList');
Route::get('/removeWishList/{id}', 'Frontend\FrontendController@removeWishList');


//userprofile
Route::get('/profile', 'Frontend\profileController@index')->name('profile');

Route::get('/myAccount', 'Frontend\profileController@userAccount')->name('user.account');

Route::get('/trackOrder', 'Frontend\profileController@trackOrder')->name('track.order');

Route::get('/order', 'Frontend\profileController@getOrder')->name('user.order');

Route::get('/show-order/{id}', 'Frontend\profileController@showOrder')->name('show.order');





Route::get('/passwordchange', 'Frontend\profileController@showChangePasswordForm')->name('update.password');

Route::post('/updatePassword', 'Frontend\profileController@updatePassword')->name('changepassword');

Route::get('/myAddress', 'Frontend\profileController@userAddress')->name('myaddress');


Route::post('/orderStatus', 'Frontend\profileController@orderStatus')->name('order.status');

Route::get('/getStatus', 'Frontend\profileController@getStatus')->name('get.status');


//manage mail
Route::get('manageMailChimp', 'Frontend\MailChimpController@manageMailChimp');
Route::post('subscribe',['as'=>'subscribe','uses'=>'Frontend\MailChimpController@subscribe']);
Route::post('sendCompaign',['as'=>'sendCompaign','uses'=>'Frontend\MailChimpController@sendCompaign']);
















 


// Route::get('google', function () {

//     return view('googleAuth');

// });

// Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');

// Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('demo1',function(){

  return  $countries= App\State::where('countryID', 1)
                    ->get();

});



Route::resource('address', 'Frontend\addressController');
Route::resource('manage', 'manageController');
Route::resource('manage_user_contacts', 'manage_user_contactsController');
Route::resource('manage_user_email', 'manage_user_emailController');