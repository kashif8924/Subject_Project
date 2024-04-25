<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
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

Route::get('/',[UserController::class,'index']);

Route::post('/signup',[UserController::class,'signup']);

Route::get('/login',[LoginController::class,'index']);

Route::post('/checklogin', [LoginController::class, 'login']);

// Route::get('/subjects',[SubjectController::class,'index'])->middleware('auth');

// Route::get('/selectsubject', [SubjectController::class,'test'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/viewsubject',[SubjectController::class,'viewSubject']);
    Route::get('/select/{Subject_ID}',[SubjectController::class,'selectSubject']);
    Route::get('/drop/{subject_id}',[SubjectController::class,'dropSubject']);
    Route::any('/search',[SubjectController::class,'search']);
});
