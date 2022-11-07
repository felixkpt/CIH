<?php 
use Illuminate\Support\Facades\Route;
use \CIH\Core\App\Http\Controllers\MinistriesController;

Route::prefix('/ministries')->controller(MinistriesController::class)->group(function () {
    Route::get('/', 'index')->name('ministries');
    Route::post('/', 'store');
});