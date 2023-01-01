<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

//LOGİN
Route::prefix('admin')->name('admin.')->middleware(['isLogin'])->group(function(){
    Route::get('login', 'App\Http\Controllers\LoginController@login')->name('login');
    Route::post('check', 'App\Http\Controllers\LoginController@check')->name('login.post');
});

//STUDENT
Route::group(["middleware"=>"isAdmin"], function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    Route::post('/destroy', [StudentController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
    Route::post('/update', [StudentController::class, 'update'])->name('update');
});


