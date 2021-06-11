<?php

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

Route::get('/', function () {
    return view('site.index');
});

Route::get('/news', function () {
    return view('site.news');
});

Route::get('/about', function () {
    return view('site.about');
});
Route::get('/structure', function () {
    return view('site.struct');
});
Route::get('/contact', function () {
    return view('site.contact');
});
Route::get('/courses', function () {
    return view('site.courses');
});

Route::get('/one-course/{course}', function ($course) {
    return view('site.one-course')->with('courses', $course);
});
