<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\CreditNoteController;
use App\Http\Controllers\Api\DebitNoteController;
use App\Http\Controllers\Api\ParchaseController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RequisitionController;
use App\Http\Controllers\Api\RevenueController;
use App\Http\Controllers\Api\WingController;
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

Route::middleware('auth:api')->get('/v1.0/user', function (Request $request) {
    return $request->user();
});
    Route::post('/v1.0/login', [AuthController::class, "login"]);
    Route::post('/v1.0/register', [AuthController::class, "register"]);
// protected routes
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/v1.0/logout', [AuthController::class, "logout"]);
// products
        Route::post('/v1.0/products', [ProductController::class, "createProduct"]);
        Route::get('/v1.0/products', [ProductController::class, "getProducts"]);
        Route::get('/v1.0/products/search/{search}', [ProductController::class, "searchProductByName"]);
// requisitions
        Route::post('/v1.0/requisitions', [RequisitionController::class, "createRequisition"]);
        Route::get('/v1.0/requisitions', [RequisitionController::class, "getRequisitions"]);
        Route::get('/v1.0/parchases', [ParchaseController::class, "getRequisitions"]);
        // parchases
        Route::post('/v1.0/parchases', [ParchaseController::class, "createRequisition"]);
        Route::put('/v1.0/requisitionToParchase', [RequisitionController::class, "requisitionToParchase"]);
        // revenue
        Route::post('/v1.0/revenues', [RevenueController::class, "createRevenue"]);
        Route::get('/v1.0/revenues', [RevenueController::class, "getRevenues"]);
        // credit notes
        Route::post('/v1.0/credit-notes', [CreditNoteController::class, "createCreditNote"]);
        Route::get('/v1.0/credit-notes', [CreditNoteController::class, "getCreditNotes"]);
        // Bills
        Route::post('/v1.0/bills', [BillController::class, "createBill"]);
        Route::get('/v1.0/bills', [BillController::class, "getBills"]);
        // Payment
        Route::post('/v1.0/payments', [PaymentController::class, "createPayment"]);
        Route::get('/v1.0/payments', [PaymentController::class, "getPayment"]);
        // debit note
        Route::post('/v1.0/debit-notes', [DebitNoteController::class, "createDebitNote"]);
        Route::get('/v1.0/debit-notes', [DebitNoteController::class, "getDebitNotes"]);
         // wing
         Route::post('/v1.0/wings', [WingController::class, "createWing"]);
         Route::get('/v1.0/wings', [WingController::class, "getWings"]);


    });

