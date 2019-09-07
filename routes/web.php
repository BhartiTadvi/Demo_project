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

 Route::get('/shopper','Frontend\FrontendController@index')->name('shopper');

  Route::get('/registeruser','Frontend\RegistrationController@create')->name('registeruser');

 Route::post('/register/store','Frontend\RegistrationController@store')->name('user.store');

Route::post('/userlogin','Frontend\LoginController@login')->name('userlogin');
 

 Route::get('/loginuser','Frontend\LoginController@create')->name('loginuser');

 Route::get('/contactus','Frontend\FrontendController@contact')->name('contactus');








Route::get('/product_image', 'ProductImageController@create')->name('product_image');
Route::get('/product_attribute', 'Product_attributeController@create')->name('product_attribute');
Route::post('/attribute/store','Product_attributeController@store')->name('store_attribute');




Route::post('/image/store','ProductImageController@store')->name('store_image');


Route::get('/subcategory', 'SubcategoryController@create')->name('create.subcategory');

Route::post('/subcategory/store','SubcategoryController@store')->name('store_subcategory');
Route::post('/category','CategoryController@formAction');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('Roles','RoleController');
    Route::resource('Users','UserController');
    
});

Route::resource('admin/posts', 'Admin\\PostsController');
Route::resource('banners', 'BannersController');
Route::resource('category', 'CategoryController');
Route::resource('posttable', 'PosttableController');
Route::resource('products', 'ProductsController');

Route::resource('product_image', 'Product_imageController');

Route::get('/get/subcategories','CategoryController@getSubCategory')->name('getSubCategory');
// Route::get('/get/{id}','CategoryController@getSubCategory');
Route::resource('admin/posts', 'Admin\\PostsController');
Route::resource('coupon/coupon', 'Coupon\\CouponController');