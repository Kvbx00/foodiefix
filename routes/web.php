<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HealthDataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdministratorAuthController;
use App\Http\Controllers\AdministratorController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/admin/dashboard', function () {
    return view('administrator.dashboard');
})->middleware('admin');

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

Route::get('/userPanel/profile', [UserController::class, 'showProfile'])->name('user.profile')->middleware('auth');
Route::put('/userPanel/profile/{id}', [UserController::class, 'updateProfile'])->name('user.update')->middleware('auth');

Route::get('/adminLogin', [AdministratorAuthController::class, 'showAdminLoginView'])->name('admin.login');
Route::post('/adminLogin', [AdministratorAuthController::class, 'adminLogin']);
Route::post('/adminLogout', [AdministratorAuthController::class, 'adminLogout'])->name('admin.logout');

Route::get('/adminRegister', [AdministratorAuthController::class, 'showAdminRegistrationView'])->name('admin.register')->middleware('admin');
Route::post('/adminRegister', [AdministratorAuthController::class, 'adminRegister'])->middleware('admin');

Route::get('/admin/dashboard/userProfile', [AdministratorController::class, 'showUserProfile'])->name('administrator.userProfile')->middleware('admin');
Route::get('/admin/dashboard/userProfile/{id}/edit', [AdministratorController::class, 'editUserProfile'])->name('administrator.editUserProfile')->middleware('admin');
Route::put('/admin/dashboard/userProfile/{id}', [AdministratorController::class, 'updateUserProfile'])->name('administrator.updateUserProfile')->middleware('admin');

Route::get('/admin/dashboard/userDisease', [AdministratorController::class, 'showUserDisease'])->name('administrator.userDisease')->middleware('admin');
Route::get('/admin/dashboard/userDisease/addUserDisease', [AdministratorController::class, 'showAddUserDiseaseView'])->name('administrator.addUserDisease')->middleware('admin');
Route::post('/admin/dashboard/addUserDisease/add', [AdministratorController::class, 'addUserDisease'])->name('administrator.saveUserDisease')->middleware('admin');
Route::delete('/admin/dashboard/userDisease/removeUserDisease/{userDiseaseId}', [AdministratorController::class, 'removeUserDisease'])->name('administrator.removeUserDisease')->middleware('admin');

Route::get('/admin/dashboard/userHealthData', [AdministratorController::class, 'showUserHealthData'])->name('administrator.userHealthData')->middleware('admin');
Route::get('/admin/dashboard/userHealthData/{id}/edit', [AdministratorController::class, 'editUserHealthData'])->name('administrator.editUserHealthData')->middleware('admin');
Route::put('/admin/dashboard/userHealthData/{id}', [AdministratorController::class, 'updateUserHealthData'])->name('administrator.updateUserHealthData')->middleware('admin');
Route::delete('/admin/dashboard/userHealthData/removeUserHealthData/{healthDataId}', [AdministratorController::class, 'removeUserHealthData'])->name('administrator.removeUserHealthData')->middleware('admin');

Route::get('/admin/dashboard/userIngredientPreference', [AdministratorController::class, 'showUserIngredientPreference'])->name('administrator.userIngredientPreference')->middleware('admin');
Route::get('/admin/dashboard/userIngredientPreference/adduserIngredientPreference', [AdministratorController::class, 'showAddUserIngredientPreferenceView'])->name('administrator.addUserIngredientPreference')->middleware('admin');
Route::post('/admin/dashboard/addUserIngredientPreference/add', [AdministratorController::class, 'addUserIngredientPreference'])->name('administrator.saveUserIngredientPreference')->middleware('admin');
Route::delete('/admin/dashboard/userIngredientPreference/removeUserIngredientPreference/{ingredientPreferenceId}', [AdministratorController::class, 'removeUserIngredientPreference'])->name('administrator.removeUserIngredientPreference')->middleware('admin');

Route::get('/admin/dashboard/userCaloricNeed', [AdministratorController::class, 'showUserCaloricNeed'])->name('administrator.userCaloricNeed')->middleware('admin');
Route::get('/admin/dashboard/userCaloricNeed/{id}/edit', [AdministratorController::class, 'editUserCaloricNeed'])->name('administrator.editUserCaloricNeed')->middleware('admin');
Route::put('/admin/dashboard/userCaloricNeed/{id}', [AdministratorController::class, 'updateUserCaloricNeed'])->name('administrator.updateUserCaloricNeed')->middleware('admin');
Route::delete('/admin/dashboard/userCaloricNeed/removeUserCaloricNeed/{caloricNeedId}', [AdministratorController::class, 'removeUserCaloricNeed'])->name('administrator.removeUserCaloricNeed')->middleware('admin');

Route::get('/admin/dashboard/disease', [AdministratorController::class, 'showDisease'])->name('administrator.disease')->middleware('admin');
Route::get('/admin/dashboard/disease/{id}/edit', [AdministratorController::class, 'editDisease'])->name('administrator.editDisease')->middleware('admin');
Route::put('/admin/dashboard/disease/{id}', [AdministratorController::class, 'updateDisease'])->name('administrator.updateDisease')->middleware('admin');
Route::delete('/admin/dashboard/disease/removeDisease/{diseaseId}', [AdministratorController::class, 'removeDisease'])->name('administrator.removeDisease')->middleware('admin');
Route::get('/admin/dashboard/disease/addDisease', [AdministratorController::class, 'showAddDiseaseView'])->name('administrator.addDisease')->middleware('admin');
Route::post('/admin/dashboard/disease/add', [AdministratorController::class, 'addDisease'])->name('administrator.saveDisease')->middleware('admin');

Route::get('/admin/dashboard/mealCategory', [AdministratorController::class, 'showMealCategory'])->name('administrator.mealCategory')->middleware('admin');
Route::get('/admin/dashboard/mealCategory/{id}/edit', [AdministratorController::class, 'editMealCategory'])->name('administrator.editMealCategory')->middleware('admin');
Route::put('/admin/dashboard/mealCategory/{id}', [AdministratorController::class, 'updateMealCategory'])->name('administrator.updateMealCategory')->middleware('admin');
Route::delete('/admin/dashboard/mealCategory/removeMealCategory/{mealCategoryId}', [AdministratorController::class, 'removeMealCategory'])->name('administrator.removeMealCategory')->middleware('admin');
Route::get('/admin/dashboard/mealCategory/addMealCategory', [AdministratorController::class, 'showAddMealCategoryView'])->name('administrator.addMealCategory')->middleware('admin');
Route::post('/admin/dashboard/mealCategory/add', [AdministratorController::class, 'addMealCategory'])->name('administrator.saveMealCategory')->middleware('admin');

Route::get('/admin/dashboard/meal', [AdministratorController::class, 'showMeal'])->name('administrator.meal')->middleware('admin');
Route::get('/admin/dashboard/meal/{id}/edit', [AdministratorController::class, 'editMeal'])->name('administrator.editMeal')->middleware('admin');
Route::put('/admin/dashboard/meal/{id}', [AdministratorController::class, 'updateMeal'])->name('administrator.updateMeal')->middleware('admin');
Route::delete('/admin/dashboard/meal/removeMeal/{mealId}', [AdministratorController::class, 'removeMeal'])->name('administrator.removeMeal')->middleware('admin');
Route::get('/admin/dashboard/meal/addMeal', [AdministratorController::class, 'showAddMealView'])->name('administrator.addMeal')->middleware('admin');
Route::post('/admin/dashboard/meal/add', [AdministratorController::class, 'addMeal'])->name('administrator.saveMeal')->middleware('admin');
