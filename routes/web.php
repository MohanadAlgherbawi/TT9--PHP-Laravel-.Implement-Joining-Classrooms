<?php

use App\Http\Controllers\ClassroomsController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/classrooms',[ClassroomsController::class, 'index']);
Route::get('/classrooms/create',[ClassroomsController::class,'create']);

Route::get('classrooms/{classroom}/{edit?}',[ClassroomsController::class,'show'])
->where('classroom', '\d+');// // Regular expression to ensure classroom is a numberq
    