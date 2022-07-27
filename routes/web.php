<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontendController;
use App\Models\BloodRequest;
use App\Models\Event;
use App\Models\Role;
use App\Models\User;
use Barryvdh\Debugbar\DataCollector\EventCollector;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Auth;
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
        Route::get('/events/{id}','eventsView')->name('guest-events.view');
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



Route::prefix('dashboard')->middleware(['auth','verified'])->group(function () {
    Route::get('/myprofile/donation-status',[DonorController::class,'makeActive'])->name('donationStatusChange');
    Route::post('/myprofile/update',[DonorController::class,'update'])->name('profile.update');
    Route::post('/myprofile/donation',[DonorController::class,'donationStore'])->name('donation.update');
    Route::post('/myprofile/change-password',[ChangePasswordController::class,'store'])->name('change.password');
    Route::controller(BackendController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });
    Route::get('/myprofile',[DonorController::class,'profile'])->name('profile');
    Route::get('/events/req/pending',[EventController::class,'eventsPending'])->name('dashboard.events.pending');
    Route::get('/events/req/accept/{id}',[EventController::class,'approve'])->name('event-request-accept');
    Route::get('/events/req/decline/{id}',[EventController::class,'decline'])->name('event-request-decline');
    Route::get('/donor-req',[DonorController::class, 'pendingDonorsRequest'])->name('donor-request');
    Route::get('/donor-req/approve/{id}',[DonorController::class, 'acceptDonors'])->name('donor-request-accept');
    
    Route::patch('/donor-req/{id}/decline',[DonorController::class, 'rejectDonors'])->name('donor-request-decline');

    Route::get('/active-donor', [DonorController::class, 'activeDonors'])->name('active-donor');

    Route::controller(DonorController::class)->prefix('/donor/blood')->group(function () {
        Route::get('/all','list')->name('donor.list');
        Route::get('/requests', 'index')->name('donor-blood-reqs');
        Route::get('/requests/{id}/accept', 'accept')->name('donor-req-accept');
        Route::get('/requests/{id}/donated', 'donated')->name('donor-req-donated');
        Route::get('/requests/{id}/not-donated', 'notDonated')->name('donor-req-notdonated');
    });




    Route::controller(BloodRequestController::class)->group(function () {
        Route::get('/blood-req/not-approved', 'pending')->name('request.notApproved');
        Route::get('/blood-req/approve/{id}', 'approve')->name('blood-approve');
        Route::patch('/blood-req/reject/{id}', 'reject')->name('blood-reject');
        Route::get('/blood-req/assign/{bloodRequest}', 'assignIndex')->name('request-assign');
        Route::post('/blood-req/assign-donor/{bloodRequest}', 'assignDonor')->name('donor-assign');
        Route::get('/blood-req-all', 'allRequests')->name('blood-request-all');
        Route::get('/blood-req', 'create')->name('blood-req');
        Route::post('/blood-req', 'store')->name('blood-store');
        Route::get('/blood-req/{id}', 'show')->name('blood-view');
        Route::get('/blood-req/{id}/edit', 'edit')->name('blood-edit');
    });

   
    Route::get('/events-trash', [EventController::class, 'trash'])->name('events.trash');
    Route::resource('events', EventController::class);
});











require __DIR__ . '/auth.php';
