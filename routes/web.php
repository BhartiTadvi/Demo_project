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
 Route::get('/homeshopper','Frontend\FrontendController@index')->name('home_shopper');
 Route::get('/loginuser','Frontend\RegistrationController@create')->name('loginuser');
 Route::post('/register/store','Frontend\RegistrationController@store')->name('user.store');
 Route::post('/userlogin','Frontend\LoginController@login')->name('userlogin');
 Route::post('/logoutuser','Frontend\LoginController@logout')->name('logoutuser');
 Route::get('/contactus','Frontend\FrontendController@contact')->name('contactus');
 Route::get('/productsinfo/{id}','Frontend\FrontendController@showProduct')->name('product.show');


// Route::get('google', function () {

//     return view('googleAuth');

// });

// Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');

// Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');



