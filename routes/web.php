<?php

use App\Http\Controllers\AcceptanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentExportController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\WebAdminController;
use App\Http\Controllers\WebController;
use App\Http\Middleware\CheckAcceptancePermission;
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

Route::get('/', function () {
    return redirect('/auth');
});

Route::prefix('/staff')->middleware(['auth:web', 'role:staff'])->group(function () {

    Route::get('/', function () {
        return redirect()->route('staff.home');
    });

    Route::get('/home', [WebController::class, 'showHome'])->name('staff.home');

    Route::get('/request/my_request', [WebController::class, 'showMyRequest'])->name('staff.request.myrequest');
    Route::get('/request/my_request/{id}', [WebController::class, 'showMyRequestById'])->name('staff.request.myrequestbyid');

    Route::get('/request/add_request', [WebController::class, 'showAddRequest'])->name('staff.request.add_request');
    Route::post('/request/add_request', [RequestController::class, 'addRequest'])->name('staff.request.add_request.post');

    Route::get('/settlement', [WebController::class, 'showSettlement'])->name('staff.settlement');
    Route::get('/settlement/{id}', [WebController::class, 'showUploadSettlement'])->name('staff.settlement.upload');
    Route::post('/settlement/{id}', [SettlementController::class, 'updateSettlement'])->name('staff.settlement.upload.post');

    Route::prefix('/acceptance')
        ->middleware(CheckAcceptancePermission::class)
        ->group(function () {
            Route::get('/', [WebController::class, 'showAcceptance'])->name('staff.acceptance');

            Route::get('/accept/{id}', [AcceptanceController::class, 'acceptRequest'])->name('staff.acceptance.accept');
            Route::get('/decline/{id}', [AcceptanceController::class, 'declineRequest'])->name('staff.acceptance.decline');
        });

    Route::get('/profile', [WebController::class, 'showProfile'])->name('staff.profile');
    Route::get('/profile/edit', [WebController::class, 'showEditProfile'])->name('staff.edit_profile');
    Route::post('/profile/edit', [StaffController::class, 'editStaff'])->name('staff.edit_profile.post');

    Route::get('/list_donator', [WebController::class, 'showListDonator'])->name('staff.list_donator');

    Route::get('/export/{id}', [PaymentExportController::class, 'export'])->name('export.pr');

    Route::get('/export_pdf/{id}', [PaymentExportController::class, 'exportPdf'])->name('export.pdf');
});

Route::prefix('/admin')->middleware(['auth:web', 'role:admin'])->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.home');
    });

    Route::get('/home', [WebAdminController::class, 'showHome'])->name('admin.home');

    Route::get('/stafff', [WebAdminController::class, 'showStaff'])->name('admin.staff');

    Route::get('/add_staff', [WebAdminController::class, 'addStaff'])->name('admin.add_staff');
    Route::post('/add_staff', [StaffController::class, 'register'])->name('admin.add_staff.post');

    Route::get('/edit_staff/{id}', [WebAdminController::class, 'showEditStaff'])->name('admin.edit_staff');
    Route::post('/edit_staff/{staff}', [StaffController::class, 'edit'])->name('admin.edit_staff.post');

    Route::get('/delete_staff/{id}', [StaffController::class, 'delete'])->name('admin.delete_staff');

    Route::get('/position', [WebAdminController::class, 'showListPosition'])->name('admin.position');

    Route::get('/add_position', [WebAdminController::class, 'showAddPosition'])->name('admin.add_position');
    Route::post('/add_position', [PositionController::class, 'createPosition'])->name('admin.add_position.post');

    Route::get('/edit_position/{id}', [WebAdminController::class, 'showEditPosition'])->name('admin.edit_position');
    Route::post('/edit_position/{position}', [PositionController::class, 'editPosition'])->name('admin.edit_position.post');

    Route::get('/delete_position/{id}', [PositionController::class, 'deletePosition'])->name('admin.delete_position');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('auth')->group(function () {

    Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/', [AuthController::class, 'postLogin'])->name('auth.login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('auth.register.post');
});
