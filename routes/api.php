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
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/news/admins', [App\Http\Controllers\NewsController::class, 'index']);
  Route::post('/news', [App\Http\Controllers\NewsController::class, 'store']);
  Route::get('/news/{news}', [App\Http\Controllers\NewsController::class, 'show']);
  Route::put('/news/update/{news}', [App\Http\Controllers\NewsController::class, 'update']);
  Route::delete('/news/delete/{news}', [App\Http\Controllers\NewsController::class, 'destroy']);
});
/*
|--------------------------------------------------------------------------
| news images API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/news/images', [App\Http\Controllers\NewsImagesController::class, 'index']);
  Route::post('/news/images/{new}', [App\Http\Controllers\NewsImagesController::class, 'store']);
  Route::get('/news/images/{newsImages}', [App\Http\Controllers\NewsImagesController::class, 'show']);
  Route::put('/news/update/images/{newsImages}', [App\Http\Controllers\NewsImagesController::class, 'update']);
  Route::delete('/news/delete/images/{newsImages}', [App\Http\Controllers\NewsImagesController::class, 'destroy']);
});
/*
|--------------------------------------------------------------------------
| Categories API Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/categories/{categories}', [App\Http\Controllers\CategoriesController::class, 'show']);
Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('/categories', [App\Http\Controllers\CategoriesController::class, 'store']);
  Route::put('/categories/{categories}', [App\Http\Controllers\CategoriesController::class, 'update']);
  Route::delete('/categories/{categories}', [App\Http\Controllers\CategoriesController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Teachers API Routes
|--------------------------------------------------------------------------
|
*/

Route::post('/teachers/login', [App\Http\Controllers\TeachersController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/teachers', [App\Http\Controllers\TeachersController::class, 'index']);
  Route::post('/teachers', [App\Http\Controllers\TeachersController::class, 'store']);
  Route::get('/teachers/{teachers}', [App\Http\Controllers\TeachersController::class, 'show']);
  Route::post('/teachers/{teachers}', [App\Http\Controllers\TeachersController::class, 'update']);
  Route::delete('/teachers/{teachers}', [App\Http\Controllers\TeachersController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| permisions API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/teachers/permisions', [App\Http\Controllers\PermisionsAdminsController::class, 'index']);
  Route::post('/teachers/permisions/teachers', [App\Http\Controllers\PermisionsAdminsController::class, 'store']);
  Route::get('/teachers/permisions/teachers/{teachers}', [App\Http\Controllers\PermisionsAdminsController::class, 'show']);
  Route::put('/teachers/permisions/update/{permisionsTeachers}', [App\Http\Controllers\PermisionsAdminsController::class, 'update']);
});

/*
|--------------------------------------------------------------------------
| Students API Routes
|--------------------------------------------------------------------------
|
*/

Route::post('/students/login', [App\Http\Controllers\StudentsController::class, 'login']);
Route::post('/students', [App\Http\Controllers\StudentsController::class, 'store']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/students', [App\Http\Controllers\StudentsController::class, 'index']);
  Route::get('/students/{students}', [App\Http\Controllers\StudentsController::class, 'show']);
  Route::post('/students/upload/{students}', [App\Http\Controllers\StudentsController::class, 'editupload']);
  Route::put('/students/{students}', [App\Http\Controllers\StudentsController::class, 'update']);
  Route::put('/students/active/{students}', [App\Http\Controllers\StudentsController::class, 'active']);
  Route::delete('/students/{students}', [App\Http\Controllers\StudentsController::class, 'destroy']);
});
/*
|--------------------------------------------------------------------------
| Courses API Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/courses/page/{ofset}', [App\Http\Controllers\CoursesController::class, 'index']);
Route::get('/courses/{courses}', [App\Http\Controllers\CoursesController::class, 'show']);
Route::get('/courses/search/categories', [App\Http\Controllers\CoursesController::class, 'search']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('/courses', [App\Http\Controllers\CoursesController::class, 'store']);
  Route::put('/courses/active/{courses}', [App\Http\Controllers\CoursesController::class, 'active']);
  Route::post('/courses/{courses}', [App\Http\Controllers\CoursesController::class, 'update']);
  Route::delete('/courses/{courses}', [App\Http\Controllers\CoursesController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Courses Details API Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/courses/details/out/{coursesDetails}', [App\Http\Controllers\CoursesDetailsController::class, 'showout']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/courses/details/{course}', [App\Http\Controllers\CoursesDetailsController::class, 'index']);
  Route::post('/courses/details/add', [App\Http\Controllers\CoursesDetailsController::class, 'store']);
  Route::get('/courses/details/{coursesDetails}', [App\Http\Controllers\CoursesDetailsController::class, 'show']);
  Route::put('/courses/details/update/{coursesDetails}', [App\Http\Controllers\CoursesDetailsController::class, 'update']);
  Route::delete('/courses/details/{coursesDetails}', [App\Http\Controllers\CoursesDetailsController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| unites API Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/courses/unites/{course}', [App\Http\Controllers\CoursesDetailsUnitesController::class, 'index']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('/courses/unites/create', [App\Http\Controllers\CoursesDetailsUnitesController::class, 'store']);
  Route::get('/courses/unites/{coursesDetailsUnites}', [App\Http\Controllers\CoursesDetailsUnitesController::class, 'show']);
  Route::post('/courses/unites/update/{coursesDetailsUnites}', [App\Http\Controllers\CoursesDetailsUnitesController::class, 'update']);
  Route::delete('/courses/unites/{coursesDetailsUnites}', [App\Http\Controllers\CoursesDetailsUnitesController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Unit Video API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/unites/{units}', [App\Http\Controllers\UnitVideoController::class, 'index']);
  Route::put('/unites/{units}', [App\Http\Controllers\UnitVideoController::class, 'update']);
  Route::post('/unites', [App\Http\Controllers\UnitVideoController::class, 'store']);
  Route::delete('/unites/{unitVideo}', [App\Http\Controllers\UnitVideoController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Unit Files API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/unites/files/{units}', [App\Http\Controllers\UnitsFilesController::class, 'index']);
  Route::post('/unites/files/{units}', [App\Http\Controllers\UnitsFilesController::class, 'update']);
  Route::post('/unites/files', [App\Http\Controllers\UnitsFilesController::class, 'store']);
  Route::delete('/unites/files/{unitsFiles}', [App\Http\Controllers\UnitsFilesController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| carts API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/carts', [App\Http\Controllers\CartsController::class, 'index']);
  Route::get('/carts/details/{cart}', [App\Http\Controllers\CartsDetailsController::class, 'index']);
  Route::post('/carts', [App\Http\Controllers\CartsController::class, 'store']);
  Route::post('/carts/details/add', [App\Http\Controllers\CartsDetailsController::class, 'store']);
  Route::delete('/carts', [App\Http\Controllers\CartsController::class, 'destroy']);
  Route::delete('/carts/details/{cartsDetails}', [App\Http\Controllers\CartsDetailsController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| siders API Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/siders', [App\Http\Controllers\SettingsSiderController::class, 'index']);
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::put('/siders/{settingsSider}', [App\Http\Controllers\SettingsSiderController::class, 'update']);
  Route::delete('/siders/{settingsSider}', [App\Http\Controllers\SettingsSiderController::class, 'destroy']);
  Route::post('/siders', [App\Http\Controllers\SettingsSiderController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| logout API Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
