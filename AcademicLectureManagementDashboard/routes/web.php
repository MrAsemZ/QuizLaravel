<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('lecturers', LecturerController::class);
