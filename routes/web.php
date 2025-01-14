<?php

use App\Models\Contact;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;

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

Auth::routes();
//Start - PageController
//Trang index
Route::get('/', 'PageController@index')->name('index');
//Trang contact
Route::get('/contact', 'PageController@contact')->name('contact');
Route::post('/contact/save', 'PageController@saveContact')->name('contact.save');
//Cart
Route::get('cart', 'PageController@cart')->name('cart')->middleware('checkLogin');
Route::get('cart/add/{slug}', 'CartController@addToCart')->name('cart.add')->middleware('checkLogin');
Route::get('cart/delete/{id}', 'CartController@cartDelete')->name('cart.delete');
Route::post('cart/update', 'CartController@cartUpdate')->name('cart.update');

//Coupon apply
Route::post('/coupon/apply', 'CouponController@couponApply')->name('coupon.apply');

//Checkout
Route::get('checkout', 'PageController@checkout')->name('checkout')->middleware('checkLogin');

//Place order
Route::post('place-order', 'OrderController@store')->name('order.store')->middleware('checkLogin');

//--- Begin Blog ---
Route::get('blog', 'PageController@getBlog')->name('blog.all');
Route::get('blog/{slug}', 'PageController@getBlogDetailByID')->name('blog.detail');
Route::get('blog/category/{id}', 'PageController@getBlogCategoryByID')->name('blog.category');
Route::get('blog/search/key', 'PageController@blogSearch')->name('blog.search');
//--- End Blog ---


//--- Begin Shop ---

Route::get('product/{slug}', 'PageController@getProductBySlug')->name('product.detail');
Route::get('product/{id}', 'PageController@getCategogyBySlug');
Route::get('product/category/{id}', 'PageController@getCategogyProductById')->name('product.category');
Route::get('product/search/key', 'PageController@productSearch')->name('product.search');
//End - PageController

//Trang danh sách yêu thích
Route::get('wishlist', 'PageController@showWishList')->name('wishlist')->middleware('checkLogin');
Route::get('wishlist/add/{productId}', 'PageController@addWishList')->name('wishlist.add')->middleware('checkLogin');
Route::get('wishlist/remove/{productId}', 'PageController@removeWishList')->name('wishlist.remove');

//Export pdf order detail
Route::get('order/pdf/{id}', 'OrderController@pdfGenerate')->name('order.pdf')->middleware('checkLogin');

//File manager
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
//comment post
Route::resource('comment', 'PostCommentController');

//-----------------Backend (ADMIN) route group start-------------------
Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    //Contacts
    Route::get('contacts', 'AdminController@showAllContact')->name('contacts.index')->middleware('checkRole:admin,mod');
    //Update profile
    Route::post('/profile/{id}', 'UserController@profileUpdate')->name('admin.profile.update');
    // Notification
    Route::get('/notification/{id}', 'NotificationController@show')->name('admin.notification');
    Route::get('/notifications', 'NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}', 'NotificationController@delete')->name('notification.delete');
    //Category
    Route::resource('category', 'CategoryController')->middleware('checkRole:admin,mod');
    //Product
    Route::resource('product', 'ProductController')->middleware('checkRole:admin,mod');
    //Coupon
    Route::resource('coupon', 'CouponController')->middleware('checkRole:admin,mod');
    //Product Rating
    Route::resource('rate', 'ProductReviewController')->middleware('checkRole:admin,mod');
    //Banner
    Route::resource('banner', 'BannerController')->middleware('checkRole:admin,mod');
    //Post Tag
    Route::resource('postTag', 'PostTagController')->middleware('checkRole:admin,mod');
    //Post
    Route::resource('blog', 'PostController')->middleware('checkRole:admin,mod,writer');
    //Users
    Route::resource('users', 'UserController')->middleware('checkRole:admin');
    //User profile
    Route::get('profile', 'AdminController@profile')->name('admin.profile')->middleware('checkRole:admin,mod,writter');
    //Admin
    Route::get('/', 'AdminController@index')->name('admin')->middleware('checkRole:admin,mod,writter');
    //Order
    Route::resource('order', 'OrderController')->middleware('checkLogin');
    //Post Caterogy :
    Route::resource('blogcategory', 'PostCategoryController')->middleware('checkRole:admin,mod,writer');
    // //admin profile
    // Route::get('profile', 'PageController@adminProfile')->name('admin.profile');
    Route::get('/changepassword', 'PageController@changePassword')->name('admin.change.password');
    Route::post('/changepassword/save', 'UserController@changPasswordStore')->name('admin.changepass.save');
    // Settings
    Route::get('setting', 'AdminController@settings')->name('setting')->middleware('checkRole:admin');
    Route::post('setting/update', 'AdminController@settingsUpdate')->name('setting.update');
});
//--------------------End backend route group---------------------

//---------------------User route group start---------------------
Route::group(['prefix' => '/user'], function () {
    Route::get('/profile', 'UserController@userProfile')->name('user.profile')->middleware('checkLogin');
    Route::get('/changepassword', 'PageController@changeUserPassword')->name('user.change.password');
    Route::post('/changepassword/save', 'UserController@changPasswordStore')->name('user.changepass.save');
    //User Login
    Route::get('/login', 'PageController@userLogin')->name('user.login');
    Route::post('/login', 'PageController@userLoginSubmit')->name('user.login.submit');
    //User Register
    Route::get('/register', 'PageController@userRegister')->name('user.register');
    Route::post('/register', 'PageController@userRegisterSubmit')->name('user.register.submit');
    //User Logout
    Route::get('/logout', 'PageController@userLogout')->name('user.logout');
    //User change password
    Route::get('/changepassword', 'PageController@changeUserPassword')->name('user.change.password');
    Route::post('/changepassword/save', 'UserController@changPasswordStore')->name('user.changepass.save');
    //Xac thuc user
    Route::get('/activation/{token}', 'UserController@activeUser')->name('user.activate');
    //  Order
    Route::get('/order', "UserController@orderIndex")->name('user.order.index')->middleware('checkLogin');
    Route::get('/order/show/{id}', "UserController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}', 'UserController@userOrderDelete')->name('user.order.delete');
    //wishlist
    Route::resource('wishlist', 'WishlistController')->middleware('checkLogin');
});
//---------------------End user route group-----------------------
//comment product
Route::resource('productComment', 'ProductCommentController')->middleware('checkLogin');
//  -- Lọc giá và sắp xếp danh sách sản phẩm-- 
Route::get('products', 'PageController@shop')->name('product.all');
//  -- End Lọc giá và sắp xếp -- 

//Product Rate
Route::post('rate', 'ProductReviewController@store')->name('rate.add')->middleware('checkLogin');
