<?php
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\openaicontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admincontroller;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SkinController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/Register',[Authcontroller::class, 'Register'])->name('auth.register');
Route::post('/handelregister',[Authcontroller::class,'handelregister'])->name('auth.handelregister');

Route::get('/login',[Authcontroller::class,'Login'])->name('auth.login');
Route::post('/handellogin',[Authcontroller::class,'handellogin'])->name('auth.handellogin');

Route::get('/auth/redirectgoog',[Authcontroller::class,'redirectgoog'])->name('user.redirectgoog');    
Route::get('/auth/callbackgoog',[Authcontroller::class,'callbackgoog'])->name('user.callbackgoog');


Route::fallback(fn()=>redirect(route('auth.login')));

Route::middleware('islogin')->group(function(){
    Route::fallback(fn()=>redirect(route('main.main')));


    Route::get('logout',[Authcontroller::class,'logout'])->name('auth.logout');
    
    Route::get('/skin',[SkinController::class,'main'])->name('main.main');
    
    Route::get('/model',[SkinController::class,'tomodel'])->name('main.tomodel');
    Route::post('/uploadimage',[SkinController::class,'uploadimage'])->name('main.uploadimage');
    Route::get('/profile',[ProfileController::class,'getprofile'])->name('profile.profile');
    Route::get('/doctorform',[DoctorController::class,'getform'])->name('doctors.form');
    Route::post('/doctorhandel',[DoctorController::class,'doctorhandel'])->name('doctors.doctorhandel');
    Route::get('/cities/{governorateId}', [Authcontroller::class, 'getCitiesByGovernorate']);
    Route::get('/finddoctors',[DoctorController::class,'findDoctor'])->name('doctors.finddoctors');
    Route::get('/findDoctorsByCity',[DoctorController::class,'findDoctorsByCity'])->name('doctors.findDoctorsByCity');
    Route::get('/show/doctors/{id}',[DoctorController::class,'show'])->name('doctors.show');
    Route::post('/book-slot/{id}', [DoctorController::class, 'bookSlot'])->name('slots.book');
    Route::post('/cancel/{id}', [DoctorController::class, 'cancelbooking'])->name('slots.cancelbook');
    Route::post('/Reviewstore',[ReviewController::class,'store'])->name('Reviews.store');


Route::get('/generate-slots/doctors/{id}', [DoctorController::class, 'generateSlots'])->name('doctors.generateSlots');


    
});

Route::middleware('is_admin')->group(function(){
    Route::get('/Dashboard',[Admincontroller::class,'index'])->name('dashboard.main');
    Route::delete('/Delete/{id}',[Admincontroller::class,'Deleteuser'])->name('admin.delete');
    });
