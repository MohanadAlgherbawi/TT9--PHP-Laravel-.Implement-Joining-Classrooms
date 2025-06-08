<?php

use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\TopicsController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    
})->name('home');
// Route::get('/classrooms',[ClassroomsController::class, 'index'])
// ->name('classrooms.index');
// Route::get('/classrooms/create',[ClassroomsController::class,'create'])
// ->name('classrooms.create');

// Route::get('classrooms/{classroom}/edit',[ClassroomsController::class,'edit'])
// ->name('classrooms.edit')
// ->where('classroom', '\d+');

// Route::get('classrooms/{classroom}',[ClassroomsController::class,'show'])
// ->where('classroom', '\d+')// // Regular expression to ensure classroom is a numberq
// ->name('classrooms.show');
// Route::post('/classrooms',[ClassroomsController::class,'store'])
// ->name('classrooms.store');
// Route::put('/classrooms/{classroom}',[ClassroomsController::class,'update'])
// ->name('classrooms.update')
// ->where('classroom', '\d+');
// Route::delete('/classrooms/{classroom}',[ClassroomsController::class,'destroy'])
// ->name('classrooms.destroy')
// ->where('classroom', '\d+');

Route::resource('/classrooms', ClassroomsController::class)
->names([
    'index' => 'classrooms.index',
    'create' => 'classrooms.create',
    'store' => 'classrooms.store',
    'show' => 'classrooms.show',
    'edit' => 'classrooms.edit',
    'update' => 'classrooms.update',
    'destroy' => 'classrooms.destroy',
])->parameters(['classrooms' => 'classroom']); // to use classroom instead of classrooms in the route


Route::resource('topics',TopicsController::class);

Route::resources([
    'topics'=> TopicsController::class,
    'classrooms' => ClassroomsController::class,
]);