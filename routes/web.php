<?php

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::resource('users', UserController::class);
Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
