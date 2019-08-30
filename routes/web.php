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
Route::get('/table', function () {
    return view('category.table');
    });

    

Route::get('/product_image', 'ProductImageController@create')->name('product_image');

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
Route::resource('products', 'ProductsController');

Route::resource('product_demo', 'Product_demoController');
Route::resource('posttable', 'PosttableController');
Route::resource('banners_management', 'Banners_managementController');