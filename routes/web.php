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
//home
Route::get('/', 'IndexController@homeView');
//hire page worl list
Route::get('/hire/{type}/{id}', 'hireController@hirePage');
//Cart
Route::get('/CartItem','hireController@CartListItem');


// saloon list
Route::get('/shop_salun','salonController@selectSalon');
//saloon shop details
Route::get('/shop_details/{id}','salonController@SalonDetails');




/* undefiened */
Route::get('/selectSub', 'IndexController@getSubcategory');
Route::get('/profile', 'authController@authenticate');
Route::get('/signup','authController@signUp');
Route::get('/generateOtp','authController@sendOtp');
Route::get('/sendOtp','authController@SenOTPToUser');
Route::get('/hire/address', 'hireController@SetAddresss');
Route::get('/hire/cnfrmotp', 'hireController@conformOTP');
Route::get('/hire/submit', 'hireController@hireSubmit');
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/addToCart','hireController@addToCart');


//post not verified
Route::post('/profile/submit', 'authController@profileSubmit');
Route::post('/SP/submitProfile','authController@SubmitServiceProfile');
Route::post('/signupForm', 'authController@cnfrmOTPofUser');
/* undefiend pile okay */












//Form for Partners Registration
Route::get('/regPartner','home@regPartner');
Route::post('/regPartnerSubmit','home@regPartnerSubmit');


// Login/Singup Controller
Route::post('/sendOTPtoPhone','Auth\\LoginController@sendOtp');
Route::post('/loginviaOTP','Auth\\LoginController@authenticate');
Route::get('/logout', 'Auth\\LoginController@logout');




//aboutus 
Route::get('/about',function(){
    return view('about');
});
//contactus
Route::get('/contact',function(){
    return view('contact');
});
//submiting contact us form
Route::post('submitContactForm','contact@submitContactForm');

//geting all service 
Route::post('getServices','IndexController@getAllService');

//slaon list area wiase
Route::post('findShopByArea', 'salonController@sendSaloonListByArea');

//for showing search result 
Route::get('searchResult', 'IndexController@searchResult');

//login overriding 
Route::get('login', [ 'as' => 'login',function(){
    return view('auth.login');
}]);

//Register overriding 
Route::get('register',['as'=>'register',function(){
    return view('auth.login');
}]);

//all auth based routes
Route::group(['middleware' => ['auth']], function () {
    //show order history
    Route::get('MyOrder','MyOrder_c@loadYourLotOrderPage');
    Route::get('MyOrderDetails','MyOrder_c@loadYourCartOrderPage');



    #f`or payment 
    // payment
    Route::post('/payment_failed','payuPayment@payment_success_fail');
    Route::post('/payment_success','payuPayment@payment_success_fail');
    Route::post('/checkoutCartitem/','payuPayment@openPaymentGateway');


});

//send Review form order section
Route::post('sendReviewByUser', 'MyOrder_c@submitReview');
Route::post('sendReportByUser', 'MyOrder_c@submitReport');

