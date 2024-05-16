<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\DropdownController;
use App\Models\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('/paymentTypes', [DropdownController::class, 'payment_types']);
    Route::get('/categories', [DropdownController::class, 'categories']);
    Route::get('/subCategories', [DropdownController::class, 'subCategories']);
    Route::get('/subCategories/{category_id}', [DropdownController::class, 'BasedSubCategories']);
    Route::get('/paymentPurposes', [DropdownController::class, 'paymentPurposes']);
    Route::get('/currencies', [DropdownController::class, 'currencies']);
    Route::get('/paymentPerMonths', [DropdownController::class, 'index']);
    // routes/api.php
    Route::get('/paymentSchedules', [DropdownController::class, 'PaymentSchedule']);

    Route::get('/fundSources', [DropdownController::class, 'fundSources']);

    Route::get('/priceRanges', [DropdownController::class, 'priceRanges']);
    Route::get('/countries', [DropdownController::class, 'countries']);
    Route::get('/getAllPhoneCode', [DropdownController::class, 'getAllPhoneCode']);
    Route::get('/mediums', [DropdownController::class, 'mediums']);
    Route::get('/getCurrencyCode', [DropdownController::class, 'getCurrencyCode']);

    Route::get('/beneficiariesDropdown', [DropdownController::class, 'beneficiariesDropdown']);


    Route::post('/logout', [RegistrationController::class, 'logout']);
});
///////////////Admin Middleware ///////////////////
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::middleware('admin')->group(function () {
        // Define admin routes here
        Route::get('/getAllClients', [AdminController::class, 'index']);
        Route::get('/clients/{id}', [AdminController::class, 'show']);
        Route::get('/client/Search', [AdminController::class, 'search']);

        Route::get('clients/{client_id}/beneficiaries', [AdminController::class, 'allBeneficiaries']);
        Route::get('/beneficiaries/search', [AdminController::class, 'searchBeneficiaries']);
        Route::post('/makeDeals', [AdminController::class, 'makeDeal']);
        Route::get('/deals', [AdminController::class, 'getAllDeals']);
        Route::get('/deals/search', [AdminController::class, 'searchDeals']);
        Route::put('activateUser/{user}',  [AdminController::class, 'activateUser']);

        Route::get('/revenue/today',  [AdminController::class, 'todayRevenue']);
        Route::get('/revenue/previousMonth',  [AdminController::class, 'previousMonthRevenue']);
        Route::get('/revenue/beforePreviousMonth',  [AdminController::class, 'beforePreviousMonth']);


        Route::get('/deals/today', [AdminController::class, 'totalDealsToday']); 


        Route::get('clients/{client_id}/deals', [AdminController::class, 'allClientsdeals']);
        Route::get('clients/{client_id}/deal/search', [AdminController::class, 'allDealOFClient']);
        
    });
    Route::middleware('client')->group(function () {
        // Define client routes here
        Route::post('/registerBusiness', [RegistrationController::class, 'registerBusiness']);

        //////////beneficiary ///////////////
        Route::get('/wallets/{client_id}', [ClientController::class, 'wallet'] );

        Route::post('/addBeneficiaryIndividual', [ClientController::class, 'addBeneficiaryIndividual']);
        Route::post('/addBeneficiaryBusiness', [ClientController::class, 'addBeneficiaryBusiness']);
        Route::get('/allBeneficiaries', [ClientController::class, 'index']);
        Route::put('/beneficiaries/{id}', [ClientController::class, 'update']);
        Route::delete('/deleteBeneficiaries/{id}', [ClientController::class, 'destroy']);

        Route::get('/client-beneficiary/search', [ClientController::class, 'searchBeneficiary']);
        Route::get('/client-transection/deals', [ClientController::class, 'clientTransection']);

        Route::get('/clientProfile', [ClientController::class, 'clientProfile']);
        Route::put('/changePassword', [ClientController::class, 'changePassword']);
        ///////////////////

        Route::get('/allDealsHistory', [ClientController::class, 'allDealsHistory']);
        Route::get('/searchDealsHistory', [ClientController::class, 'searchDealsHistory']);
        Route::get('/clientDeals/{id}',  [ClientController::class, 'dealsDetail']);

        Route::get('/allPaymentsHistory', [ClientController::class, 'allPaymentsHistory']);
        Route::get('/searchPaymentsHistory', [ClientController::class, 'searchPaymentsHistory']);

        Route::get('/beneficiariesDropdown/{client_id}', [ClientController::class, 'beneficiariesClientDropdown']);
        Route::post('/makeMultipleDeals', [ClientController::class, 'makeMultipleDeals']);
        Route::get('/getAuthorizedUser', [ClientController::class, 'getAuthorizedUser']);
        Route::post('/clientPermissions', [ClientController::class, 'clientPermission']);


    });
});


Route::post('/email/verify', 'VerificationController@verifyEmail');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->name('verification.verify');

Route::post('forgotPassword/email', [VerificationController::class, 'sendResetLinkEmail']);
Route::get('/password/reset/{token}', [VerificationController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset',  [VerificationController::class, 'reset']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
