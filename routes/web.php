<?php

use App\Http\Controllers\Axios\AxiosController;
use App\Http\Controllers\FancyBox\FancyBoxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\ContactsController;
use App\Http\Controllers\Pages\GuaranteesController;
use App\Http\Controllers\Pages\WorksController;
use Illuminate\Support\Facades\Route;

/** Главная **/
Route::get('/', [HomeController::class, 'index'])->name('home');
/** ///Главная **/

/** Гарантии **/
Route::get('/guarantees', [GuaranteesController::class, 'index'])->name('guarantees');
/** ///Гарантии **/

/** Работы **/
Route::get('/works', [WorksController::class, 'index'])->name('works');
/** ///Работы **/

/** Контакты **/
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
/** ///Контакты **/

/** FancyBox AJAX **/
Route::controller(FancyBoxController::class)->group(function () {
    Route::post('/fancybox-ajax', 'fancybox');
});
/** ///FancyBox AJAX **/

/** Axios async forms **/
Route::controller(AxiosController::class)->group(function () {
    Route::post('/upload-form-async', 'async');
    Route::post('/call-me-blue', 'callMeBlue');
});
/** ///Axios async forms **/
