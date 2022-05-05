<?php

use Illuminate\Support\Facades\Route;

//Input your frontsite controller here
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\AppointmentController;
use App\Http\Controllers\Frontsite\PaymentController;
use App\Http\Controllers\Frontsite\RegisterController;

//Input your backsite controller here
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\PermissionController;
use App\Http\Controllers\Backsite\RoleController;
use App\Http\Controllers\Backsite\UserController;
use App\Http\Controllers\Backsite\TypeUserController;
use App\Http\Controllers\Backsite\SpecialistController;
use App\Http\Controllers\Backsite\ConfigPaymentController;
use App\Http\Controllers\Backsite\ConsultationController;
use App\Http\Controllers\Backsite\DoctorController;
use App\Http\Controllers\Backsite\HospitalPatientController;
use App\Http\Controllers\Backsite\AppointmentBacksiteController;
use App\Http\Controllers\Backsite\TransactionBacksiteController;

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
    Route::get('appointment/doctor/{id}', [AppointmentController::class, 'appointment'])->name('appointment.doctor'); // Mengambil data dokter sesuai pilihan untuk proses appointment dengan dokter
    Route::resource('appointment', AppointmentController::class);

    // payment page
    Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success'); // Direct link controller ke payment success ketika sukses melakukan pembayaran
    Route::get('payment/appointment/{id}', [PaymentController::class, 'payment'])->name('payment.appointment'); // Melanjutkan dari appointment ke payment dengan id dokter yang sama
    Route::resource('payment', PaymentController::class);
     
    // register page
    Route::resource('register_success', RegisterController::class);
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
    Route::resource('type_user', TypeUserController::class);

    // Doctor Page di Backsite
    Route::resource('doctor', DoctorController::class);

    // Transaction Page di Backsite
    Route::resource('transaction', TransactionBacksiteController::class);

    // Report Page di Backsite
    Route::resource('report', ReportController::class);

    // Consultation Page di Backsite
    Route::resource('consultation', ConsultationController::class);

    //Config Payment Page di Backsite
    Route::resource('config_payment', ConfigPaymentController::class);

    // Specialist Page di Backsite
    Route::resource('specialist', SpecialistController::class);

    // Hospital Patient Page di Backsite
    Route::resource('hospital_patient', HospitalPatientController::class);

});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');