<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
});

Route::controller(TaskController::class)->group( function () {
    Route::get('/', 'index')->name('tasks.index');
    Route::get('tasks/create', 'create')->name('tasks.create');
    Route::post('tasks/store', 'store')->name('tasks.store');
    Route::get('tasks/{id}', 'edit')->name('tasks.edit');
    Route::put('tasks/{id}', 'update')->name('tasks.update');
    Route::delete('tasks/{id}', 'destroy')->name('tasks.destroy');
    Route::post('/tasks/re-order', 'reOrderTask')->name('task.reOrderTask');
});

Route::controller(ProjectController::class)->group( function () {
    Route::get('projects/create', 'create')->name('projects.create');
    Route::post('projects/store', 'store')->name('projects.store');
});
