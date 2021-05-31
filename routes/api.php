<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
|--------------------------------------------------------------------------
| admin API Routes
|--------------------------------------------------------------------------
|
*/

Route::post('/admin/login', [App\Http\Controllers\AdminsController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index']);
  Route::post('/admin/create', [App\Http\Controllers\AdminsController::class, 'store']);
  Route::get('/admin/show/{admins}', [App\Http\Controllers\AdminsController::class, 'show']);
  Route::put('/admin/update/{admins}', [App\Http\Controllers\AdminsController::class, 'update']);
  Route::delete('/admin/delete/{admins}', [App\Http\Controllers\AdminsController::class, 'destroy']);
});
/*
|--------------------------------------------------------------------------
| permisions API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/admin/permisions', [App\Http\Controllers\PermisionsAdminsController::class, 'index']);
  Route::post('/admin/permisions/admin', [App\Http\Controllers\PermisionsAdminsController::class, 'store']);
  Route::get('/admin/permisions/admin/{admins}', [App\Http\Controllers\PermisionsAdminsController::class, 'show']);
  Route::put('/admin/permisions/update/{admins}', [App\Http\Controllers\PermisionsAdminsController::class, 'update']);
});
/*
|--------------------------------------------------------------------------
| news API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);
  Route::post('/news', [App\Http\Controllers\NewsController::class, 'store']);
  Route::get('/news/{admins}', [App\Http\Controllers\NewsController::class, 'show']);
  Route::put('/news/update/{admins}', [App\Http\Controllers\NewsController::class, 'update']);
  Route::delete('/news/delete/{news}', [App\Http\Controllers\NewsController::class, 'destroy']);
});
/*
|--------------------------------------------------------------------------
| Categories API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index']);
  Route::post('/categories', [App\Http\Controllers\CategoriesController::class, 'store']);
  Route::get('/categories/{categories}', [App\Http\Controllers\CategoriesController::class, 'show']);
  Route::put('/categories/{categories}', [App\Http\Controllers\CategoriesController::class, 'update']);
  Route::delete('/categories/{categories}', [App\Http\Controllers\CategoriesController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Teachers API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/categories', [App\Http\Controllers\TeachersController::class, 'index']);
  Route::post('/categories', [App\Http\Controllers\TeachersController::class, 'store']);
  Route::get('/categories/{categories}', [App\Http\Controllers\TeachersController::class, 'show']);
  Route::put('/categories/{categories}', [App\Http\Controllers\TeachersController::class, 'update']);
  Route::delete('/categories/{categories}', [App\Http\Controllers\TeachersController::class, 'destroy']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
