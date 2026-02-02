<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\ComparisonMatrixController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SpkController;
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

Route::get('/', function () {
    return view('welcome');
});

// ==================== Admin =============================
Route::get('/dashboard', [CriteriaController::class, 'dashboard']);
Route::resource('criteria', CriteriaController::class);
Route::get('/comparison-matrix', [ComparisonMatrixController::class, 'index']);
Route::post('/comparison-matrix', [ComparisonMatrixController::class, 'store']);
Route::resource('/alternative', AlternativeController::class);
Route::get('/ranking', [AlternativeController::class, 'ranking']);
Route::post('/topsis-pdf', [AlternativeController::class, 'pdf']);


Route::get('/ahp-test', [SpkController::class, 'testAhp']);
