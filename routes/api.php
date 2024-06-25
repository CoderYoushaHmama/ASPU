<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthenticationController::class, 'login']);
Route::middleware('check-auth')->prefix('user')->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', [AuthenticationController::class, 'profile']);
        Route::post('/', [AuthenticationController::class, 'editProfile']);
        Route::post('/change-password', [AuthenticationController::class, 'editPassword']);
        Route::post('/logout', [AuthenticationController::class, 'logout']);
    });
    Route::middleware('manage-employee')->prefix('employees')->group(function () {
        Route::post('/', [EmployeeController::class, 'addEmployee']);
        Route::post('/{employee}', [EmployeeController::class, 'editEmployee']);
        Route::delete('/{employee}', [EmployeeController::class, 'deleteEmployee']);
        Route::get('/', [EmployeeController::class, 'getEmployees']);
        Route::get('/{employee}', [EmployeeController::class, 'getEmployeeInformation']);
    });
    Route::middleware('manage-food')->prefix('foods')->group(function () {
        Route::post('/', [FoodController::class, 'addFood']);
        Route::post('/{food}', [FoodController::class, 'editFood']);
        Route::delete('/{food}', [FoodController::class, 'deleteFood']);
        Route::get('/', [FoodController::class, 'getFoods']);
        Route::get('/{food}', [FoodController::class, 'getFoodInformation']);
    });
    Route::middleware('manage-payment-type')->prefix('payment-types')->group(function () {
        Route::post('/', [PaymentTypeController::class, 'addPaymentType']);
        Route::post('/{payType}', [PaymentTypeController::class, 'editPaymentType']);
        Route::delete('/{payType}', [PaymentTypeController::class, 'deletePaymentType']);
        Route::get('/', [PaymentTypeController::class, 'getPaymentTypes']);
        Route::get('/{payType}', [PaymentTypeController::class, 'getPaymentTypeInformation']);
    });
    Route::middleware('manage-trip')->prefix('trips')->group(function () {
        Route::post('/', [TripController::class, 'addTrip']);
        Route::post('/{trip}', [TripController::class, 'editTrip']);
        Route::delete('/{trip}', [TripController::class, 'deleteTrip']);
        Route::get('/', [TripController::class, 'getTrips']);
        Route::get('/{trip}', [TripController::class, 'getTripInformation']);
    });
    Route::middleware('manage-reservation')->prefix('reservations')->group(function () {
        Route::post('/', [ReservationController::class, 'addReservation']);
        Route::post('/{reservation}', [ReservationController::class, 'editReservation']);
        Route::delete('/{reservation}', [ReservationController::class, 'deleteReservation']);
        Route::get('/', [ReservationController::class, 'getReservations']);
        Route::get('/{reservation}', [ReservationController::class, 'getReservationInformation']);
    });
    Route::middleware('manage-offer')->prefix('offers')->group(function () {
        Route::post('/', [OfferController::class, 'addOffer']);
        Route::post('/{offer}', [OfferController::class, 'editOffer']);
        Route::delete('/{offer}', [OfferController::class, 'deleteOffer']);
        Route::get('/', [OfferController::class, 'getOffers']);
        Route::get('/{offer}', [OfferController::class, 'getOfferInformation']);
    });
    Route::middleware('ask-questioin')->prefix('ask-questions')->group(function () {
        Route::post('/', [QuestionController::class, 'addQuestion']);
        Route::post('/{question}', [QuestionController::class, 'editQuestion']);
        Route::delete('/{question}', [QuestionController::class, 'deleteQuestion']);
        Route::get('/', [QuestionController::class, 'getUserQuestions']);
        Route::get('/{question}', [QuestionController::class, 'getQuestionInformation']);
    });
    Route::middleware('answer-questioin')->prefix('answer-questions')->group(function () {
        Route::get('/', [QuestionController::class, 'getQuestions']);
        Route::get('/{question}', [QuestionController::class, 'getQuestionInformation']);
        Route::delete('/{question}', [QuestionController::class, 'deleteQuestion']);
        Route::post('/{question}', [QuestionController::class, 'answerQuestion']);
    });
});