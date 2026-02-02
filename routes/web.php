<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComparisonMatrixController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('Template.dashboard');
// });

// ==================== Admin =============================
Route::get('/', [CriteriaController::class, 'dashboard'])->middleware('auth');
Route::resource('criteria', CriteriaController::class)->middleware('auth');
Route::get('/comparison-matrix', [ComparisonMatrixController::class, 'index'])->middleware('auth');
Route::post('/comparison-matrix', [ComparisonMatrixController::class, 'store'])->middleware('auth');
Route::resource('/alternative', AlternativeController::class)->middleware('auth');
Route::get('/ranking', [AlternativeController::class, 'ranking'])->middleware('auth');
Route::post('/topsis-pdf', [AlternativeController::class, 'pdf'])->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/login', [AuthController::class, 'authentication'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/test', function () {
    return Auth::user();
});

Route::get('/ahp-test', [SpkController::class, 'testAhp'])->middleware('auth');
