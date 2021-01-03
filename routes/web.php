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

//Frontend 
Route::get('/','HomeController@index' );
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');
Route::post('/autocomplete-ajax','HomeController@autocomplete_ajax');


//Danh muc san pham trang chu
Route::get('/danh-muc/{slug_category_product}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu/{brand_slug}','BrandProduct@show_brand_home');
Route::get('/chi-tiet/{product_slug}','ProductController@details_product');
Route::post('/quickview','ProductController@quickview');
Route::post('/quickviewc','ProductController@quickviewc');
//bai viet trang chu 

Route::get('/danh-muc-bai-viet/{post_slug}','PostController@show_post');
Route::get('/bai-viet/{post_slug}','PostController@post_detail');
//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard')->middleware('RoleAdmin');
Route::get('/logout','AdminController@logout')->middleware('RoleAdmin');
Route::post('/admin-dashboard','AdminController@dashboard');

//Category Product
Route::get('/add-category-product','CategoryProduct@add_category_product')->middleware('RoleAdmin');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product')->middleware('RoleAdmin');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product')->middleware('RoleAdmin');
Route::get('/all-category-product','CategoryProduct@all_category_product')->middleware('RoleAdmin');

// Route::post('/export-csv','CategoryProduct@export_csv')->middleware('RoleAdmin');
// Route::post('/import-csv','CategoryProduct@import_csv')->middleware('RoleAdmin');


Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product')->middleware('RoleAdmin');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product')->middleware('RoleAdmin');
//category post

Route::get('/add-category-post','CategoryPostController@add_category_post')->middleware('RoleAdmin');
// Route::get('/add-post','CategoryPostController@add_post')->middleware('RoleAdmin');
Route::post('/save-category-post','CategoryPostController@save_category_post')->middleware('RoleAdmin');
Route::get('/all-category-post','CategoryPostController@all_category_post')->middleware('RoleAdmin');
Route::get('/edit-category-post/{cate_post_id}','CategoryPostController@edit_category_post')->middleware('RoleAdmin');
Route::post('/update-category-post/{cate_post_id}','CategoryPostController@update_category_post')->middleware('RoleAdmin');
Route::get('/delete-category-post/{cate_post_id}','CategoryPostController@delete_category_post')->middleware('RoleAdmin');
Route::get('/danh-muc-bai-viet/{cate_post_slug}','CategoryPostController@danh_muc_bai_viet');
//post
Route::get('/add-post','PostController@add_post')->middleware('RoleAdmin');
Route::post('/save-post','PostController@save_post')->middleware('RoleAdmin');
Route::get('/all-post','PostController@all_post')->middleware('RoleAdmin');
Route::get('/delete-post/{post_id}','PostController@delete_post')->middleware('RoleAdmin');
//Send Mail
Route::get('/lien-he','CustomerController@getlienhe');
Route::post('/send-mail','HomeController@send_mail');
Route::get('/change-password','CustomerController@change_password');
Route::post('/save-password','CustomerController@save_password');
Route::get('/forget-password','CustomerController@forget_password');
Route::post('/re-password','CustomerController@re_password');
Route::get('/update-new-password','CustomerController@update_new_password');
Route::post('/save-new-password','CustomerController@save_new_password');


//Login facebook
Route::get('/login-facebook','CustomerController@login_facebook');
Route::get('/callback','CustomerController@callback_facebook');
//Login google
Route::get('/login-google','CustomerController@login_google');
Route::get('/google/callback','CustomerController@callback_google');

Route::post('/save-category-product','CategoryProduct@save_category_product')->middleware('RoleAdmin');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product')->middleware('RoleAdmin');

//Brand Product
Route::get('/add-brand-product','BrandProduct@add_brand_product')->middleware('RoleAdmin');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product')->middleware('RoleAdmin');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product')->middleware('RoleAdmin');
Route::get('/all-brand-product','BrandProduct@all_brand_product')->middleware('RoleAdmin');

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product')->middleware('RoleAdmin');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product')->middleware('RoleAdmin');

Route::post('/save-brand-product','BrandProduct@save_brand_product')->middleware('RoleAdmin');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product')->middleware('RoleAdmin');

//Product
Route::get('/add-product','ProductController@add_product')->middleware('RoleAdmin');
Route::get('/edit-product/{product_id}','ProductController@edit_product')->middleware('RoleAdmin');
Route::get('/delete-product/{product_id}','ProductController@delete_product')->middleware('RoleAdmin');
Route::get('/all-product','ProductController@all_product')->middleware('RoleAdmin');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product')->middleware('RoleAdmin');
Route::get('/active-product/{product_id}','ProductController@active_product')->middleware('RoleAdmin');

Route::post('/save-product','ProductController@save_product')->middleware('RoleAdmin');
Route::post('/update-product/{product_id}','ProductController@update_product')->middleware('RoleAdmin');

Route::post('/rating/{product_id}','ProductController@rating_product');

//Coupon
Route::post('/check-coupon','CartController@check_coupon');

Route::get('/unset-coupon','CouponController@unset_coupon');
Route::get('/insert-coupon','CouponController@insert_coupon')->middleware('RoleAdmin');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon')->middleware('RoleAdmin');
Route::get('/list-coupon','CouponController@list_coupon')->middleware('RoleAdmin');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code')->middleware('RoleAdmin');

//Cart
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/update-cart','CartController@update_cart');
Route::post('/save-cart','CartController@save_cart');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/show-cart','CartController@show_cart');
Route::get('/gio-hang','CartController@gio_hang');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::get('/del-product/{session_id}','CartController@delete_product');
Route::get('/del-all-product','CartController@delete_all_product');

//Checkout

Route::get('/dang-nhap','CheckoutController@login_checkout');
Route::get('/dang-ky','CheckoutController@dang_ky');
Route::get('/del-fee','CheckoutController@del_fee');

Route::get('/logout-checkout','CustomerController@logout_checkout');
Route::post('/add-customer','CustomerController@add_customer');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/login-customer','CustomerController@login_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/confirm-order','CheckoutController@confirm_order');

//Order

Route::get('/print-order/{checkout_code}','OrderController@print_order')->middleware('RoleAdmin');
Route::get('/manage-order','OrderController@manage_order')->middleware('RoleAdmin');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');
Route::get('/delete-order/{order_code}','OrderController@delete_order')->middleware('RoleAdmin');
Route::get('/history-checkout','OrderController@history_checkout');
Route::get('/view-detail-history-checkout/{order_code}','OrderController@view_detail_history_checkout');
Route::get('/cancel-order/{order_code}','OrderController@cancel_order');


//Delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');

//Banner
Route::get('/manage-slider','SliderController@manage_slider')->middleware('RoleAdmin');
Route::get('/add-slider','SliderController@add_slider')->middleware('RoleAdmin');
Route::post('/insert-slider','SliderController@insert_slider')->middleware('RoleAdmin');
Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide')->middleware('RoleAdmin');
Route::get('/active-slide/{slide_id}','SliderController@active_slide')->middleware('RoleAdmin');
Route::get('/delete-slide/{slide_id}','SliderController@delete_slide')->middleware('RoleAdmin');

//Gallery
Route::get('/add-gallery/{product_id}','GalleryController@add_gallery')->middleware('RoleAdmin');
Route::post('/select-gallery','GalleryController@select_gallery')->middleware('RoleAdmin');
Route::post('/insert-gallery/{product_id}','GalleryController@insert_gallery');
Route::post('/update-gallery-name','GalleryController@update_gallery_name');
Route::post('/delete-gallery','GalleryController@delete_gallery');
Route::post('/update-gallery','GalleryController@update_gallery');

