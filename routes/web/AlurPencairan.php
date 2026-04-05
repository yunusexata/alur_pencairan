<?php

use App\Http\Controllers\AlurPencairan\AlurPencairanController;
use App\Http\Controllers\AlurPencairan\AlurProsesNormalController;
use App\Http\Controllers\AlurPencairan\AlurProsesProses80Controller;
use App\Http\Controllers\AlurPencairan\AlurProsesSpeed20Controller;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'access_permission'])->group(function () {

    Route::group(["controller" => AlurPencairanController::class, "prefix" => "alur_pencairan", "as" => "alur_pencairan."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => AlurProsesSpeed20Controller::class, "prefix" => "alur_proses_speed_20", "as" => "alur_proses_speed_20."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => AlurProsesNormalController::class, "prefix" => "alur_proses_normal", "as" => "alur_proses_normal."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => AlurProsesProses80Controller::class, "prefix" => "alur_proses_proses_80", "as" => "alur_proses_proses_80."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
});
