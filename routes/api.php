<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\CreditNoteController;
use App\Http\Controllers\Api\DebitNoteController;
use App\Http\Controllers\Api\ParchaseController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RequisitionController;
use App\Http\Controllers\Api\RevenueController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\UserController;
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
    // parchases
    Route::get('/v1.0/parchases', [ParchaseController::class, "getParchases"]);
    Route::post('/v1.0/parchases', [ParchaseController::class, "createParchase"]);
    Route::put('/v1.0/requisitionToParchase', [RequisitionController::class, "requisitionToParchase"]);
    // revenue
    Route::post('/v1.0/revenues', [RevenueController::class, "createRevenue"]);
    Route::get('/v1.0/revenues', [RevenueController::class, "getRevenues"]);
    Route::put('/v1.0/revenues/approve', [RevenueController::class, "approveRevenue"]);

    // credit notes
    Route::post('/v1.0/credit-notes', [CreditNoteController::class, "createCreditNote"]);
    Route::get('/v1.0/credit-notes', [CreditNoteController::class, "getCreditNotes"]);
    Route::put('/v1.0/credit-notes/approve', [CreditNoteController::class, "approveCreditNote"]);
    // Bills

    Route::post('/v1.0/bills', [BillController::class, "createBill"]);
    Route::get('/v1.0/bills', [BillController::class, "getBills"]);
    Route::get('/v1.0/bills/{wingId}', [BillController::class, "getBillsByWing"]);

    // Payment
    Route::post('/v1.0/payments', [PaymentController::class, "createPayment"]);
    Route::get('/v1.0/payments', [PaymentController::class, "getPayment"]);
    Route::put('/v1.0/payments/approve', [PaymentController::class, "approvePayment"]);
    // debit note
    Route::post('/v1.0/debit-notes', [DebitNoteController::class, "createDebitNote"]);
    Route::get('/v1.0/debit-notes', [DebitNoteController::class, "getDebitNotes"]);
    Route::put('/v1.0/debit-notes/approve', [DebitNoteController::class, "approveDebitNote"]);
    // wing
    Route::post('/v1.0/wings', [WingController::class, "createWing"]);
    Route::get('/v1.0/wings', [WingController::class, "getWings"]);
    Route::get('/v1.0/wings/all', [WingController::class, "getAllWings"]);
    //  bank
    Route::post('/v1.0/banks', [BankController::class, "createBank"]);
    Route::get('/v1.0/banks', [BankController::class, "getBanks"]);
    Route::get('/v1.0/banks/wing/{wing_id}', [BankController::class, "getBanksByWing"]);
    // balance
    Route::get('/v1.0/balance/total', [BalanceController::class, "getTotalBalance"]);
    Route::get('/v1.0/balance/wing-bank/{wing_id}/{bank_id}', [BalanceController::class, "getBalanceByWingAndBank"]);
    Route::get('/v1.0/balance/wing/{wing_id}', [BalanceController::class, "getBalanceByWing"]);
    Route::patch('/v1.0/balance/transfer', [BalanceController::class, "transferBalance"]);
    // user
    Route::post('/v1.0/users', [UserController::class, "createUser"]);
    Route::get('/v1.0/users', [UserController::class, "getUsers"]);
    // roles
    Route::post('/v1.0/roles', [RolesController::class, "createRole"]);
    Route::get('/v1.0/roles', [RolesController::class, "getRoles"]);
});
