<?php

use App\Http\Controllers\Admin\Admin\FaqController;
use App\Http\Controllers\Admin\Admin\SettingController;
use App\Http\Controllers\Admin\Seller\SellerRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\CommentController;
use App\Http\Controllers\Website\QuestionController;
use App\Http\Controllers\Website\TestimonialController;
use Illuminate\Support\Facades\Auth;
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

// *************** Website Routes *************************
Route::get('/', [App\Http\Controllers\Website\AuctionController::class, 'index'])->name("/");
Route::get('/car/search', [App\Http\Controllers\Website\AuctionController::class, 'search'])->name("search.car");
Route::get('detail/{id}', [App\Http\Controllers\Website\AuctionController::class, 'detail']);
Route::get('/swagged-auto', [App\Http\Controllers\Website\AuctionController::class, 'swagged']);
Route::get('/sell-car', [App\Http\Controllers\Website\SellacarContoller::class, 'index']);
Route::post('/comment/add', [CommentController::class, 'add_comment']);
Route::post('/question/add', [QuestionController::class, 'add_question']);
Route::post('/add-testimonial/{id}', [TestimonialController::class, 'add_testimonial']);
Route::post('bid-post/{id}', [App\Http\Controllers\Website\AuctionController::class, 'bid_post']);
Route::post('newsletter', [App\Http\Controllers\Website\AuctionController::class, 'newsletter']);
Route::post('setcookie', [App\Http\Controllers\Website\AuctionController::class, 'setCookie']);
// *************** End Website Routes *********************

Auth::routes();

// *************** Admin Routes *************************
Route::get('/admin/register', [App\Http\Controllers\Admin\Admin\RegisterController::class, 'index']);
Route::post('/admin/registeration', [App\Http\Controllers\Admin\Admin\RegisterController::class, 'create']);

Route::group(['middleware' => ['adminAuth', 'auth']], function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\Admin\DashboardController::class, 'index']);
    Route::resource('/admin/car', App\Http\Controllers\Admin\Admin\CarController::class);
    Route::post('/admin/car/featured/{id}', [App\Http\Controllers\Admin\Admin\CarController::class, 'featured']);
    Route::post('/admin/car/set_bid_time', [App\Http\Controllers\Admin\Admin\CarController::class, 'set_bid_time']);
    Route::get('/admin/comments', [CommentController::class, 'comments']);
    Route::get('/admin/change-status/{id}', [CommentController::class, 'change_status']);
    Route::post('/admin/car-status', [App\Http\Controllers\Admin\Admin\CarController::class, 'car_status']);
    Route::get('/admin/sellers', [App\Http\Controllers\Admin\Admin\SellerController::class, 'index']);
    Route::get('/admin/buyers', [App\Http\Controllers\Admin\Admin\BuyerController::class, 'index']);
    Route::get('/admin/sellers/{id}', [App\Http\Controllers\Admin\Admin\SellerController::class, 'show']);
    Route::get('/admin/seller-requests', [App\Http\Controllers\Admin\Admin\SellerController::class, 'seller_request']);
    Route::post('/admin/seller-request/{id}', [App\Http\Controllers\Admin\Admin\SellerController::class, 'seller_request_status']);
    Route::get('/admin/buyers/{id}', [App\Http\Controllers\Admin\Admin\BuyerController::class, 'show']);
    Route::get('/user/profile', [ProfileController::class, 'show']);
    Route::get('/user/edit-profile', [ProfileController::class, 'edit']);
    Route::post('/user/update-profile/{id}', [ProfileController::class, 'update']);
    Route::post('admin/user-status/{id}', [App\Http\Controllers\Admin\Admin\BuyerController::class, 'user_status']);
    Route::get('admin/testimonials', [TestimonialController::class, 'index']);
    Route::post('admin/testimonial-status/{id}', [TestimonialController::class, 'change_status']);
    Route::resource('admin/faq', FaqController::class);
    Route::resource('admin/settings', SettingController::class);
    // Route::resource('admin/settings', SettingController::class);


});
// *************** End Admin Routes *********************

// *************** Buyer Routes *************************
Route::get('register', [App\Http\Controllers\Admin\Buyer\RegisterController::class, 'index']);
Route::post('/buyer/registeration', [App\Http\Controllers\Admin\Buyer\RegisterController::class, 'create']);

Route::group(['middleware' => ['sellerAuth', 'auth']], function () {
    Route::get('/buyer/dashboard', [App\Http\Controllers\Admin\Buyer\DashboardController::class, 'index']);
});
// *************** End Buyer Routes *************************

// *************** Seller Routes *************************
Route::get('/seller/register', [App\Http\Controllers\Admin\Seller\RegisterController::class, 'index']);
Route::post('/seller/registeration', [App\Http\Controllers\Admin\Seller\RegisterController::class, 'create']);
Route::get('auth/google', [App\Http\Controllers\Admin\Seller\RegisterController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\Admin\Seller\RegisterController::class, 'handleGoogleCallback']);
Route::group(['middleware' => ['sellerAuth', 'auth']], function () {
    Route::get('/seller/dashboard', [App\Http\Controllers\Admin\Seller\DashboardController::class, 'index']);
    Route::resource('/seller/car', App\Http\Controllers\Admin\Seller\CarController::class);
    Route::post('/seller/car/featured/{id}', [App\Http\Controllers\Admin\Seller\CarController::class, 'featured']);
    Route::get('/seller/car/request/{id}', [App\Http\Controllers\Admin\Seller\CarController::class, 'car_request']);
    Route::resource('/seller/seller-request', SellerRequestController::class);
    Route::get('/seller/comments', [CommentController::class, 'comments']);
    Route::get('/seller/change-status/{id}', [CommentController::class, 'change_status']);
    Route::get('/seller/questions', [QuestionController::class, 'questions']);
    Route::get('/seller/question-answer/{id}', [QuestionController::class, 'edit_question']);
    Route::post('/seller/update-question/{id}', [QuestionController::class, 'update_question']);
});
// *************** End Seller Routes *************************

// *************** Common routes **************************
Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/profile', [ProfileController::class, 'show']);
    Route::get('/user/edit-profile', [ProfileController::class, 'edit']);
    Route::post('/user/update-profile/{id}', [ProfileController::class, 'update']);
});
// *************** End Common routes **************************
