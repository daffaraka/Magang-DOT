<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RasHewanController;
use App\Http\Controllers\JenisHewanController;
use App\Http\Controllers\PostAdopsiController;
use App\Http\Controllers\API\RasHewanAPIController;
use App\Http\Controllers\API\JenisHewanAPIController;
use App\Http\Controllers\API\PostAdopsiAPIController;
use App\Models\RasHewan;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


// API Jenis Hewan


Route::get('/dashboard',function() {
return view('dashboard.dashboard-index');
})->name('dashboard')->middleware('auth');


Route::apiResource('/api/JenisHewanAPI',JenisHewanAPIController::class);
Route::get('/api/JenisHewanAPI/search/{JenisHewan}',[JenisHewanAPIController::class,'search']);

// CRUD Jenis Hewan
Route::get('/JenisHewan',[JenisHewanController::class,'index'])->name('JenisHewan.index');
Route::get('/JenisHewan/create',[JenisHewanController::class,'create'])->name('JenisHewan.create');
Route::post('/JenisHewan/store',[JenisHewanController::class,'store'])->name('JenisHewan.store');
Route::get('/JenisHewan/edit/{id}',[JenisHewanController::class,'edit'])->name('JenisHewan.edit');
Route::post('/JenisHewan/update/{id}',[JenisHewanController::class,'update'])->name('JenisHewan.update');
Route::get('/JenisHewan/delete/{id}',[JenisHewanController::class,'destroy'])->name('JenisHewan.destroy');
Route::post('/JenisHewan/search',[JenisHewanController::class,'search'])->name('JenisHewan.search');


// API Ras Hewan
Route::apiResource('/api/RasHewanAPI',RasHewanAPIController::class);
Route::get('/api/RasHewanAPI/search/{RasHewan}',[RasHewanAPIController::class,'search']);

// CRUD Ras Hewan
Route::get('/RasHewan',[RasHewanController::class,'index'])->name('RasHewan.index');
Route::get('/RasHewan/create',[RasHewanController::class,'create'])->name('RasHewan.create');
Route::post('/RasHewan/store',[RasHewanController::class,'store'])->name('RasHewan.store');
Route::get('/RasHewan/edit/{id}',[RasHewanController::class,'edit'])->name('RasHewan.edit');
Route::post('/RasHewan/update/{id}',[RasHewanController::class,'update'])->name('RasHewan.update');
Route::get('/RasHewan/delete/{id}',[RasHewanController::class,'destroy'])->name('RasHewan.destroy');
Route::post('/RasHewan/search',[RasHewanController::class,'search'])->name('RasHewan.search');


// API Post Adopsi
Route::apiResource('/api/PostAdopsiAPI',PostAdopsiAPIController::class);
Route::get('/api/PostAdopsiAPI/search/{Adopsi}',[PostAdopsiAPIController::class,'search']);

// CRUD Post Adopsi
Route::get('/PostAdopsi',[PostAdopsiController::class,'index'])->name('PostAdopsi.index');
Route::get('/PostAdopsi/create',[PostAdopsiController::class,'create'])->name('PostAdopsi.create');
Route::post('/PostAdopsi/store',[PostAdopsiController::class,'store'])->name('PostAdopsi.store');
Route::get('/PostAdopsi/edit/{id}',[PostAdopsiController::class,'edit'])->name('PostAdopsi.edit');
Route::post('/PostAdopsi/update/{PostAdopsi}',[PostAdopsiController::class,'update'])->name('PostAdopsi.update');
Route::get('/PostAdopsi/delete/{id}',[PostAdopsiController::class,'destroy'])->name('PostAdopsi.destroy');
Route::get('/PostAdopsi/find-ras-hewan',[PostAdopsiController::class,'getRasHewan']);
Route::post('/PostAdopsi/search',[PostAdopsiController::class,'search'])->name('PostAdopsi.search');

require __DIR__.'/auth.php';
