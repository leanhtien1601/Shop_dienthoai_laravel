<?php

use Illuminate\Support\Facades\Route;

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

// font_end
Route::fallback(function(){
    return view('font_end.notfound');
});
Route::group(['prefix'=>'font_end'], function(){
    Route::get('/','HomeController@index')
    ->name('home.index');

    // show sản phẩm
    Route::get('/show-{id_cate}','ProductController@showProduct')
    ->name('product.showProduct');

    // chi tiết sản phẩm
    Route::get('/detail/{id}','ProductController@detail')
    ->name('product.detail');

    // đăng nhập tài khoản



    //Quản lí tài khoản
    Route::match(['get','post'],'/user/add','UserController@add')
        ->name('user.add');

    Route::get('/user/show','UserController@index')
        ->name('back_end.user.index')
        // phân quyền
        ->middleware('can:User.show');

    Route::match(['get','post'],'/user/login','UserController@login')
        ->name('font_end.user.login');

    Route::get('/logout','UserController@logout')
        ->name('font_end.user.logout');
    Route::match(['get','post'],'/user/editPass/{id}','UserController@EditPass')
    ->name('font_end.user.editpass');


    //edit account
    Route::match(['get','post'],'user/edit-{id}','UserController@edit')
        ->name('user.edit')
        ->middleware('can:user.edit');


    // show giỏ hàng
    Route::get('/showcart','CartController@showCart')
        ->name('cart.showCart');

    Route::get('/add-cart/{id}','CartController@AddCart')
        ->name('Product.AddCart')
        ->where('id','[0-9]+');

    Route::match(['get','post'],'/gio-hang','CartController@GioHang')
        ->name('Product.GioHang');

    Route::get('/huyGioHang','CartController@huyGioHang')
        ->name('Product.huy');

    ;


});
Route::get('/xem-san-pham-{id}.html','HomeController@showSP')
    ->name('product.show');



// back_end
Route::group(['prefix'=>'back_end'], function(){


    // quản lí sản phẩm
    Route::match(['get','post'],'/product/add','ProductController@addProduct')
        ->name('back_end.product.addProduct')
        ->middleware('can:product.add');

    Route::get('/product/show','ProductController@index')
        ->name('back_end.product.index')
        ->middleware('can:product.show');

    Route::match(['get', 'post'],'/product/edit/{id}', 'ProductController@edit')
        ->where(['id'=>'[0-9]+'])
        ->name('back_end.product.edit')
        ->middleware('can:product.edit');

    Route::match(['get', 'post'],'/product/xoa/{id}', 'ProductController@delete')
        ->where(['id'=>'[0-9]+'])
        ->name('back_end.product.xoa')
        ->middleware('can:product.xoa');

    // tìm kiếm sản phẩm
    Route::get('product/search','ProductController@search')
        ->name('product.search');


    // quản lí danh mục
    Route::match(['get','post'],'/category/add','CategoryController@add')
        ->name('back_end.category.add')
        ->middleware('can:category.add');

    Route::get('/category/show','CategoryController@showCategory')
        ->name('back_end.category.showCategory')
        ->middleware('can:category.show');

    Route::match(['get', 'post'],'/category/edit/{id_cate}', 'CategoryController@edit')
        ->where(['id_cate'=>'[0-9]+'])
        ->name('back_end.category.edit')
        ->middleware('can:category.edit');

    Route::match(['get', 'post'],'/category/xoa/{id_cate}', 'CategoryController@delete')
        ->where(['id_cate'=>'[0-9]+'])
        ->name('back_end.category.xoa')
        ->middleware('can:category.delete');

    // quản lí slider
    Route::match(['get','post'],'/slider/add','SliderController@add')
        ->name('back_end.slider.add')
        ->middleware('can:slider.add');

    Route::get('/slider/show','SliderController@index')
        ->name('back_end.slider.index')
        ->middleware('can:slider.show');

    Route::match(['get', 'post'],'/slider/edit/{id}', 'SliderController@edit')
        ->where(['id'=>'[0-9]+'])
        ->name('back_end.slider.edit')
        ->middleware('can:slider.edit');

    Route::match(['get', 'post'],'/slider/xoa/{id}', 'SliderController@xoa')
        ->where(['id'=>'[0-9]+'])
        ->name('back_end.slider.xoa')
        ->middleware('can:slider.xoa');
    //gửi Mail
    Route::match(['get', 'post'],'/mail','HomeController@sendMail')
        ->name('admin.sendMail');
});

