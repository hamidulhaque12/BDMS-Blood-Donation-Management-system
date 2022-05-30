<?php

use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontendController;
use App\Models\BloodRequest;
use App\Models\User;
use Illuminate\Routing\RouteRegistrar;
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




Route::prefix('/')->group(function () {


    Route::controller(FrontendController::class)->group(function () {
        Route::get('/', 'index')->name('welcome');;
        Route::get('/events', 'events')->name('events');
    });
    Route::get('/about-us', function () {
    return view('about');
})->name('about');
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

    Route::get('/blood-req', [FrontendController::class, 'bloodRequestCreate'])->name('bloodreq-user');
    Route::post('/blood-req', [FrontendController::class, 'bloodRequestStore'])->name('bloodreq-user-store');
});



Route::prefix('dashboard')->middleware(['auth'])->group(function () {
   

    Route::get('/donor-req', function () {
        return view('backend/donor-requests');
    })->name('donor-request');
    Route::get('/active-donor', [DonorController::class, 'activeDonors'])->name('active-donor');

    Route::controller(DonorController::class)->prefix('/donor/blood')->group(function () {
      Route::get('/requests','index')->name('donor-blood-reqs');
      Route::get('/requests/{id}/accept','accept')->name('donor-req-accept');

    });

    Route::controller(BloodRequestController::class)->group(function () {
        Route::get('/','index')->name('dashboard');
        Route::get('/blood-req/not-approved', 'pending')->name('request.notApproved');
        Route::get('/blood-req/approve/{id}', 'approve')->name('blood-approve');
        Route::get('/blood-req/reject/{id}', 'reject')->name('blood-reject');
        Route::get('/blood-req/assign/{bloodRequest}','assignIndex')->name('request-assign');
        Route::post('/blood-req/assign-donor/{bloodRequest}','assignDonor')->name('donor-assign');
        Route::get('/blood-req-all', 'allRequests')->name('blood-request-all');
        Route::get('/blood-req', 'create')->name('blood-req');
        Route::post('/blood-req', 'store')->name('blood-store');
        Route::get('/blood-req/{id}', 'show')->name('blood-view');
        Route::get('/blood-req/{id}/edit', 'edit')->name('blood-edit');
    });

    Route::resource('donor', DonorController::class);

   

    Route::get('/events-trash', [EventController::class, 'trash'])->name('events.trash');
    Route::resource('events', EventController::class);
});









// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
