<?php

use App\Http\Controllers\Auth\CustomeAuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Relations\RelationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\SocialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('fillable' , [CrudController::class , 'getOffer']);

//Route::get('' , [CrudController::class , 'store']);
//LaravelLocalization::setLocale() --------->(en , ar)
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], // to make redirect if language not found
function(){
    //Route::get('store' , [CrudController::class , 'store']);
    // to add prefix before name of language in route
    Route::group(['prefix' => 'offers'],
    function(){
        Route::get('create' , [CrudController::class , 'create']);
        //route to store data in DB
        Route::post('store' , [CrudController::class , 'store'])->name('offers.store');
        //idea ===> make button --> route --> controller --> blade
        Route::get('edit/{offer_id}' , [CrudController::class , 'editOffer']);// return id ---> offer
        Route::post('update/{offer_id}' , [CrudController::class , 'updateOffer'])->name('offers.update');
        Route::get('delete/{offer_id}' , [CrudController::class , 'delete'])->name('offers.delete');

        Route::get('all' , [CrudController::class , 'getAllOffers'])->name('offers.all');
    });

    Route::get('youtube' , [CrudController::class , 'getVideo'])->middleware('auth');


});


//facebook
Route::get('redirect/{service}' , [SocialController::class , 'redirect']);
Route::get('callback/{service}' , [SocialController::class , 'callback']);




################## Begin Ajax routes ##################

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], // to make redirect if language not found
function() {
    Route::group(['prefix' => 'ajax-offers'], function () {

        Route::get('create', [OfferController::class, 'create']);
        Route::post('store', [OfferController::class, 'store'])->name('ajax.offer.store');
        Route::post('delete', [OfferController::class, 'delete'])->name('ajax.offer.delete');
        Route::get('edit/{offer_id}' , [OfferController::class , 'edit'])->name('ajax.offers.edit');
        Route::post('update' , [OfferController::class , 'update'])->name('ajax.offers.update');

        Route::get('all', [OfferController::class, 'all'])->name('ajax_offers.all');

    });
});

################## End Ajax routes ##################

################## Begin Authentication && Guards ##################
Route::get('/dashboard' , function(){
   return "You Are Not Allowed To Register";
})->name('not.adult');

    Route::group(['middleware' => 'checkAge'], function () {
    Route::get('adults', [CustomeAuthController::class, 'adults'])->name('adults');
});


Route::get('site', [CustomeAuthController::class, 'site'])->middleware('auth:web')->name('site'); // web (users)
Route::get('admin', [CustomeAuthController::class, 'admin'])->middleware('auth:admin')->name('admin');

Route::get('admin/login', [CustomeAuthController::class, 'AdminLogin'])->name('admin.login');
Route::post('admin/login', [CustomeAuthController::class, 'checkAdminLogin'])->name('save.admin.login');

################## End Authentication && Guards ##################


################## Start Relations Routes ##################

// one to one
Route::get('has-one' ,[RelationsController::class , 'hasOneRelations']);
Route::get('has-one-reverse' ,[RelationsController::class , 'hasOneRelationsReverse']);
Route::get('get-user-has-phone' ,[RelationsController::class , 'getUserHasPhone']);
Route::get('get-user-not-has-phone' ,[RelationsController::class , 'getUserNotHasPhone']);
Route::get('get-user-has-phone-with-condition' ,[RelationsController::class , 'getUserHasPhoneWithCondition']);


// one to many
Route::get('hospital-has-many' ,[RelationsController::class , 'getHospitalDoctors']);

//send data to view
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], // to make redirect if language not found
function() {
        Route::get('hospitals' ,[RelationsController::class , 'getHospitalData'])->name('hospitals.all');
        Route::get('doctor/{hospital_id}' ,[RelationsController::class , 'hospitalDoctors'])->name('hospitals.doctors');
        Route::get('hospitals/{hospital_id}' ,[RelationsController::class , 'deleteHospital'])->name('delete.hospital');
});


// one to many whereHas , whereDoesNotHave
Route::get('hospital_has-doctors' ,[RelationsController::class , 'getHospitalHasDoctors']);

Route::get('hospital_has_doctors_male' ,[RelationsController::class , 'getHospitalHasDoctorsMale']);

Route::get('hospital_Not_has_doctors' ,[RelationsController::class , 'getHospitalNotHasDoctors']);

/////////////many to many
Route::get('doctor_services',[RelationsController::class , 'getDoctorServices']);
Route::get('doctor_by_services',[RelationsController::class , 'getDoctorByServices']);


################## End Relations Routes ##################



