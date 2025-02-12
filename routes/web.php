<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->role == 1) {
            return redirect()->route('admin-dashboard');
           }
           if (auth()->user()->role == 2) {
            return redirect()->route('serviceprovider-dashboard');
           }
           else{
            return redirect()->route('client-dashboard');
           }
         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){

        Route::get('/admin', function(){
            return view('admin.index');
        })->name('admin-dashboard');

        Route::get('/serviceprovider', function(){
            return view('admin.service-provider');
        })->name('serv');

        Route::get('/appointments', function(){
            return view('admin.appointments');
        })->name('appointment-list');

     });

     Route::prefix('client')->middleware('client')->group(function(){

        Route::get('/client', function(){
            return view('client.index');
        })->name('client-dashboard');

        Route::get('/services', function(){
            return view('client.services');
        })->name('servi');


        Route::get('/appointments', function(){
            return view('client.appointments');
        })->name('apps');

        Route::get('/messages', function(){
            return view('client.client-service-provider-chat');
        })->name('mess');




     });

     Route::prefix('serviceprovider')->middleware('serviceprovider')->group(function(){

        Route::get('/serviceprovider', function(){
            return view('serviceprovider.index');
        })->name('serviceprovider-dashboard');

        Route::get('/appointments', function(){
            return view('serviceprovider.appointments');
        })->name('app');

        Route::get('/serviceoffered', function(){
            return view('serviceprovider.service-offered');
        })->name('service-off');

        Route::get('/profile', function(){
            return view('serviceprovider.profile');
        })->name('prof');

        Route::get('/message', function(){
            return view('serviceprovider.chat');
        })->name('message');

     });

     Route::get('/appointments/{appointment}/receipt', [App\Http\Controllers\AppointmentController::class, 'printReceipt'])->name('appointments.printReceipt');
Route::get('/logout', [AuthController::class, 'logout'])->name('log');
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
