<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HealthDataController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');;

Route::get('/register', [AuthController::class, 'showRegistrationView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/userPanel', [HealthDataController::class, 'showUserPanelView'])->name('userPanel')->middleware('auth');
Route::post('/userPanel/storeMeasurements', [HealthDataController::class, 'storeMeasurements'])->name('measurements.store')->middleware('auth');

Route::post('/userPanel/storeDiseases', [HealthDataController::class, 'storeDiseases'])->name('diseases.store')->middleware('auth');
Route::delete('/userPanel/destroyDiseases/{id}', [HealthDataController::class, 'destroyDiseases'])->name('diseases.destroy')->middleware('auth');

Route::post('/userPanel/storeIngredients', [HealthDataController::class, 'storeIngredients'])->name('ingredients.store')->middleware('auth');
Route::delete('/userPanel/destroyIngredients/{id}', [HealthDataController::class, 'destroyIngredients'])->name('ingredients.destroy')->middleware('auth');

Route::get('/userPanel/profile', [UserController::class, 'showProfile'])->name('user.profile');
Route::put('/userPanel/profile/{id}', [UserController::class, 'updateProfile'])->name('user.update');

