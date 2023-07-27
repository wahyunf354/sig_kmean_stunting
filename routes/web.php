<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KmeansController;
use App\Http\Controllers\StuntingController;
use App\Http\Controllers\VariablePenilaianController;
use App\Http\Middleware\Authenticate;
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
})->name("home");

Route::post('/singin', [AuthController::class, 'signin'])->name('signin');
Route::middleware(Authenticate::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/data_cluster', [ClusterController::class, 'index'])->name('admin.data_cluster');
    Route::get('/data_cluster/create', [ClusterController::class, 'create'])->name('admin.data_cluster.create');
    Route::get('/data_cluster/edit/{id}', [ClusterController::class, 'edit'])->name('admin.data_cluster.edit');
    Route::post('/data_cluster', [ClusterController::class, 'store'])->name('admin.data_cluster.store');
    Route::put('/data_cluster', [ClusterController::class, 'update'])->name('admin.data_cluster.update');
    Route::delete('/data_cluster/{id}', [ClusterController::class, 'destroy'])->name('admin.data_cluster.destroy');

    Route::get('/variable_penilaian', [VariablePenilaianController::class, 'index'])->name('admin.variable_penilaian');
    Route::post('/variable_penilaian', [VariablePenilaianController::class, 'store'])->name('admin.variable_penilaian.store');
    Route::delete('/variable_penilaian/{id}', [VariablePenilaianController::class, 'destroy'])->name('admin.variable_penilaian.destroy');
    Route::get('/variable_penilaian/create', [VariablePenilaianController::class, 'create'])->name('admin.variable_penilaian.create');
    Route::get('/variable_penilaian/edit/{id}', [VariablePenilaianController::class, 'edit'])->name('admin.variable_penilaian.edit');
    Route::put('/variable_penilaian/update', [VariablePenilaianController::class, 'update'])->name('admin.variable_penilaian.update');

    Route::get('/stunting', [StuntingController::class, 'index'])->name('admin.stunting');
    Route::get('/stunting/create', [StuntingController::class, 'create'])->name('admin.stunting.create');
    Route::get('/stunting/edit/{id}', [StuntingController::class, 'edit'])->name('admin.stunting.edit');
    Route::post('/stunting', [StuntingController::class, 'store'])->name('admin.stunting.store');
    Route::put('/stunting', [StuntingController::class, 'update'])->name('admin.stunting.update');
    Route::delete('/stunting/{id}', [StuntingController::class, 'destroy'])->name('admin.stunting.destroy');

    Route::get('/kmeans', [KmeansController::class, 'index'])->name('admin.kmeans');
});
Route::get('/getDataStunting', [DashboardController::class, 'getDataStunting']);
