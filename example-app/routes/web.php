<?php

use Illuminate\Support\Facades\Route;

//Input your frontsite controller here
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\AppointmentController;
use App\Http\Controllers\Frontsite\PaymentController;

//Input your backsite controller here
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\PermissionController;
use App\Http\Controllers\Backsite\RoleController;
use App\Http\Controllers\Backsite\UserController;
use App\Http\Controllers\Backsite\AppointmentBacksiteController;
use App\Http\Controllers\Backsite\TypeUserController;
use App\Http\Controllers\Backsite\DoctorController;
use App\Http\Controllers\Backsite\TransactionController;
use App\Http\Controllers\Backsite\ReportController;
use App\Http\Controllers\Backsite\SpecialistController;
use App\Http\Controllers\Backsite\ConsultationController;
use App\Http\Controllers\Backsite\ConfigPaymentController;

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

Route::resource('/', LandingController::class);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    // appointment page
    Route::resource('appointment', AppointmentController::class);

    // payment page
    Route::resource('payment', PaymentController::class);
});

Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum', 'verified']], function () {

    // Dashboard Page di backsite
    Route::resource('dashboard', DashboardController::class);

    // Permission Page di backsite
    Route::resource('permission', PermissionController::class);

    // Role Page di Backsite
    Route::resource('role', RoleController::class);

    // User Page di Backsite
    Route::resource('user', UserController::class);

    // Appointment Page di Backsite
    Route::resource('appointment', AppointmentBacksiteController::class);

    // Type User Page di Backsite
    Route::resource('type-user', TypeUserController::class);

    // Doctor Page di Backsite
    Route::resource('doctor', DoctorController::class);

    // Transaction Page di Backsite
    Route::resource('transaction', TransactionController::class);

    // Report Page di Backsite
    Route::resource('report', ReportController::class);

    // Consultation Page di Backsite
    Route::resource('consultation', ConsultationController::class);

    //Config Payment Page di Backsite
    Route::resource('config-payment', ConfigPaymentController::class);

    // Specialist Page di Backsite
    Route::resource('specialist', SpecialistController::class);

});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');