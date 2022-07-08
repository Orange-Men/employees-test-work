<?php

use App\Http\Controllers\EmployeeController;
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
    return redirect()->route('employees.index');
});

Route::prefix('employees')->name('employees.')->group(function () {
    Route::get('/{department?}', [EmployeeController::class, 'index'])->name('index');
    Route::post('/', [EmployeeController::class, 'upload'])->name('upload');
});
