<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\DashboardController;
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
});
