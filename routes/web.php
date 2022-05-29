<?php

use App\Http\Controllers\DonorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontendController;
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
    
    
    Route::controller(  FrontendController::class)->group(function () {
        Route::get('/', 'index')->name('welcome');;
        Route::get('/events', 'events')->name('events');
    });

});



Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/donor-req', function () {
        return view('backend/donor-requests');
    })->name('donor-request');
    Route::get('/active-donor',[DonorController::class,'activeDonors'])->name('active-donor');
    
   
    Route::resource('donor',DonorController::class);
   
    Route::get('/', function () {
        return view('backend/dashboard');
    })->name('dashboard');
   
    Route::get('/events-trash',[EventController::class,'trash'])->name('events.trash');
    Route::resource('events', EventController::class);
    
  
});








// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
