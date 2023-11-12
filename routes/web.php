<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HealthDataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdministratorAuthController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MealController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('administrator.dashboard');
})->middleware('admin');

Route::get('/register', [AuthController::class, 'showRegistrationView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/recipes', [MealController::class, 'showRecipesView'])->name('recipes');
Route::get('/recipes/meal/{id}', [MealController::class, 'showRecipesMeal'])->name('recipes.meal');

Route::get('/userPanel', [HealthDataController::class, 'showUserPanelView'])->name('userPanel')->middleware('auth');
Route::post('/userPanel/storeMeasurements', [HealthDataController::class, 'storeMeasurements'])->name('measurements.store')->middleware('auth');

Route::get('/user/menu', [MenuController::class, 'showMenu'])->name('menu.show')->middleware('auth');
Route::post('/user/menu/create', [MenuController::class, 'createMenu'])->name('menu.create')->middleware('auth');

Route::get('/user/menu/meal/{id}', [MealController::class, 'showMealView'])->name('meal.show')->middleware('auth');

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
Route::delete('/admin/dashboard/userProfile/removeUserProfile/{userId}', [AdministratorController::class, 'removeUserProfile'])->name('administrator.removeUserProfile')->middleware('admin');


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

Route::get('/admin/dashboard/mealIngredient', [AdministratorController::class, 'showMealIngredient'])->name('administrator.mealIngredient')->middleware('admin');
Route::get('/admin/dashboard/mealIngredient/{id}/edit', [AdministratorController::class, 'editMealIngredient'])->name('administrator.editMealIngredient')->middleware('admin');
Route::put('/admin/dashboard/mealIngredient/{id}', [AdministratorController::class, 'updateMealIngredient'])->name('administrator.updateMealIngredient')->middleware('admin');
Route::delete('/admin/dashboard/mealIngredient/removeMealIngredient/{mealIngredientId}', [AdministratorController::class, 'removeMealIngredient'])->name('administrator.removeMealIngredient')->middleware('admin');
Route::get('/admin/dashboard/mealIngredient/addMealIngredient', [AdministratorController::class, 'showAddMealIngredientView'])->name('administrator.addMealIngredient')->middleware('admin');
Route::post('/admin/dashboard/mealIngredient/add', [AdministratorController::class, 'addMealIngredient'])->name('administrator.saveMealIngredient')->middleware('admin');

Route::get('/admin/dashboard/nutritionalvalue', [AdministratorController::class, 'showNutritionalvalue'])->name('administrator.nutritionalvalue')->middleware('admin');
Route::get('/admin/dashboard/nutritionalvalue/{id}/edit', [AdministratorController::class, 'editNutritionalvalue'])->name('administrator.editNutritionalvalue')->middleware('admin');
Route::put('/admin/dashboard/nutritionalvalue/{id}', [AdministratorController::class, 'updateNutritionalvalue'])->name('administrator.updateNutritionalvalue')->middleware('admin');
Route::delete('/admin/dashboard/nutritionalvalue/removeNutritionalvalue/{nutritionalvalueId}', [AdministratorController::class, 'removeNutritionalvalue'])->name('administrator.removeNutritionalvalue')->middleware('admin');
Route::get('/admin/dashboard/nutritionalvalue/addNutritionalvalue', [AdministratorController::class, 'showAddNutritionalvalueView'])->name('administrator.addNutritionalvalue')->middleware('admin');
Route::post('/admin/dashboard/nutritionalvalue/add', [AdministratorController::class, 'addNutritionalvalue'])->name('administrator.saveNutritionalvalue')->middleware('admin');

Route::get('/admin/dashboard/ingredientCategory', [AdministratorController::class, 'showIngredientCategory'])->name('administrator.ingredientCategory')->middleware('admin');
Route::get('/admin/dashboard/ingredientCategory/{id}/edit', [AdministratorController::class, 'editIngredientCategory'])->name('administrator.editIngredientCategory')->middleware('admin');
Route::put('/admin/dashboard/ingredientCategory/{id}', [AdministratorController::class, 'updateIngredientCategory'])->name('administrator.updateIngredientCategory')->middleware('admin');
Route::delete('/admin/dashboard/ingredientCategory/removeIngredientCategory/{ingredientCategoryId}', [AdministratorController::class, 'removeIngredientCategory'])->name('administrator.removeIngredientCategory')->middleware('admin');
Route::get('/admin/dashboard/ingredientCategory/addIngredientCategory', [AdministratorController::class, 'showAddIngredientCategoryView'])->name('administrator.addIngredientCategory')->middleware('admin');
Route::post('/admin/dashboard/ingredientCategory/add', [AdministratorController::class, 'addIngredientCategory'])->name('administrator.saveIngredientCategory')->middleware('admin');

Route::get('/admin/dashboard/ingredient', [AdministratorController::class, 'showIngredient'])->name('administrator.ingredient')->middleware('admin');
Route::get('/admin/dashboard/ingredient/{id}/edit', [AdministratorController::class, 'editIngredient'])->name('administrator.editIngredient')->middleware('admin');
Route::put('/admin/dashboard/ingredient/{id}', [AdministratorController::class, 'updateIngredient'])->name('administrator.updateIngredient')->middleware('admin');
Route::delete('/admin/dashboard/ingredient/removeIngredient/{ingredientId}', [AdministratorController::class, 'removeIngredient'])->name('administrator.removeIngredient')->middleware('admin');
Route::get('/admin/dashboard/ingredient/addIngredient', [AdministratorController::class, 'showAddIngredientView'])->name('administrator.addIngredient')->middleware('admin');
Route::post('/admin/dashboard/ingredient/add', [AdministratorController::class, 'addIngredient'])->name('administrator.saveIngredient')->middleware('admin');

Route::get('/admin/dashboard/adminProfile', [AdministratorController::class, 'showAdminProfile'])->name('administrator.adminProfile')->middleware('admin');
Route::get('/admin/dashboard/adminProfile/{id}/edit', [AdministratorController::class, 'editAdminProfile'])->name('administrator.editAdminProfile')->middleware('admin');
Route::put('/admin/dashboard/adminProfile/{id}', [AdministratorController::class, 'updateAdminProfile'])->name('administrator.updateAdminProfile')->middleware('admin');
Route::delete('/admin/dashboard/adminProfile/removeAdminProfile/{adminId}', [AdministratorController::class, 'removeAdminProfile'])->name('administrator.removeAdminProfile')->middleware('admin');

Route::get('/admin/dashboard/juniorProfile', [AdministratorController::class, 'showJuniorProfile'])->name('administrator.juniorProfile')->middleware('admin');
Route::put('/admin/dashboard/juniorProfile/{id}', [AdministratorController::class, 'updateJuniorProfile'])->name('administrator.updateJuniorProfile')->middleware('admin');

Route::get('/admin/dashboard/userMenu', [AdministratorController::class, 'showUserMenu'])->name('administrator.userMenu')->middleware('admin');
Route::delete('/admin/dashboard/userMenu/removeUserMenu/{menuId}', [AdministratorController::class, 'removeUserMenu'])->name('administrator.removeUserMenu')->middleware('admin');
Route::get('/admin/dashboard/userMenu/addUserMenu', [AdministratorController::class, 'showAddUserMenuView'])->name('administrator.addUserMenu')->middleware('admin');
Route::post('/admin/dashboard/userMenu/add', [AdministratorController::class, 'addUserMenu'])->name('administrator.saveUserMenu')->middleware('admin');
Route::get('/admin/dashboard/userMenu/{id}/edit', [AdministratorController::class, 'editUserMenu'])->name('administrator.editUserMenu')->middleware('admin');
Route::put('/admin/dashboard/userMenu/{id}', [AdministratorController::class, 'updateUserMenu'])->name('administrator.updateUserMenu')->middleware('admin');

Route::get('/admin/dashboard/userMenuMeal', [AdministratorController::class, 'showUserMenuMeal'])->name('administrator.userMenuMeal')->middleware('admin');
Route::delete('/admin/dashboard/userMenuMeal/removeUserMenuMeal/{menuMealId}', [AdministratorController::class, 'removeUserMenuMeal'])->name('administrator.removeUserMenuMeal')->middleware('admin');
Route::get('/admin/dashboard/userMenuMeal/{id}/edit', [AdministratorController::class, 'editUserMenuMeal'])->name('administrator.editUserMenuMeal')->middleware('admin');
Route::put('/admin/dashboard/userMenuMeal/{id}', [AdministratorController::class, 'updateUserMenuMeal'])->name('administrator.updateUserMenuMeal')->middleware('admin');
Route::get('/admin/dashboard/userMenuMeal/addUserMenuMeal', [AdministratorController::class, 'showAddUserMenuMealView'])->name('administrator.addUserMenuMeal')->middleware('admin');
Route::post('/admin/dashboard/userMenuMeal/add', [AdministratorController::class, 'addUserMenuMeal'])->name('administrator.saveUserMenuMeal')->middleware('admin');
