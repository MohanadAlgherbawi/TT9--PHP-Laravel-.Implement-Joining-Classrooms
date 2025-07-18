<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\JoinClassroomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
});

require __DIR__.'/auth.php'; 
// scope uses and softs on select querey fun just
// and soft del is a scope fun (global scope) but we have local scope also

Route::middleware(['auth'])->group(function () {
    Route::prefix('/classrooms/trashed')
    ->as('classrooms.')
    ->controller(ClassroomsController::class)
    ->group(function () {
    Route::get( '/','trashed')->name('trashed');
    Route::put('/{classroom}', 'restore')->name('restore');
    Route::delete('/{classroom}', 'forceDelete')->name('force-delete');
    });
    Route::get('/classrooms/{classroom}/join',[JoinClassroomController::class,'create'])
    ->middleware('signed')
    ->name('classrooms.join');
    Route::post('/classrooms/{classroom}/join',[JoinClassroomController::class,'store'])->name('classrooms.join.store');
    Route::resources([
    'topics'=> TopicsController::class,
    'classrooms' => ClassroomsController::class,
    ]
    );
    Route::resource('classrooms.classworks' , ClassworkController::class)
    ;

});



