<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\Project_shiftController;
use App\Models\Shift;
use App\Http\Controllers\CsvDownloadController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'company'],function(){
    Route::get('/',[CompanyController::class, 'index'])->name('company');
    Route::get('/create',[CompanyController::class, 'create'])->name('company.create');
    Route::post('/store',[CompanyController::class, 'store'])->name('company.store');
    Route::post('/{id}/edit/',[CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::post('/destroy/{id}',[CompanyController::class, 'destroy'])->name('company.destroy');
});

Route::group(['prefix' => 'employee'],function(){
    Route::get('/',[EmployeeController::class, 'index'])->name('employee');
    Route::get('/create',[EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/store',[EmployeeController::class, 'store'])->name('employee.store');
    Route::post('/{id}/edit/',[EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/destroy/{id}',[EmployeeController::class, 'destroy'])->name('employee.destroy');
});

Route::group(['prefix' => 'project'],function(){
    Route::get('/',[ProjectController::class, 'index'])->name('project');
    Route::get('/create',[ProjectController::class, 'create'])->name('project.create');
    Route::post('/store',[ProjectController::class, 'store'])->name('project.store');
    Route::post('/{id}/edit/',[ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::post('/destroy/{id}',[ProjectController::class, 'destroy'])->name('project.destroy');
});

Route::group(['prefix' => 'shift'],function(){
    Route::get('/',[ShiftController::class, 'index'])->name('shift');
    Route::get('/create',[ShiftController::class, 'create'])->name('shift.create');
    Route::post('/store',[ShiftController::class, 'store'])->name('shift.store');
    // Route::get('/edit', [ShiftController::class, 'edit'])->name('shift.edit');
    // Route::post('/update', [ShiftController::class, 'update'])->name('shift.update');
});

Route::group(['prefix' => 'project-shift'],function(){
    Route::get('/',[Project_shiftController::class, 'index'])->name('project-shift');
    Route::post('/create',[Project_shiftController::class, 'show'])->name('project-shift.show');
});

Route::post('/csv-download', [CsvDownloadController::class, 'downloadCsv'])->name('csv');



require __DIR__.'/auth.php';
