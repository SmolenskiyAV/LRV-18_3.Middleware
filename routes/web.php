<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    //return view('welcome');
    return view('/ToDo/home');
})->name('home');

Route::get('/todo/list', [TodoController::class, 'show'])->name('list');

Route::get('/todo/create', function () {
    //return view('welcome');
    return view('/ToDo/create');
})->name('create');

Route::post('/todo/create/submit',[TodoController::class, 'add'])->name('submit');

Route::get('/todo/{id}', [TodoController::class, 'edit'])->name('edit');

Route::get('/todo/{id}/update', [TodoController::class, 'update'])->name('update');

Route::post('/todo/{id}/update', [TodoController::class, 'updateSubmit'])->name('updateSubmit');

Route::get('/todo/{id}/delete', [TodoController::class, 'delete'])->name('delete');

/*
Route::get('/todo',[\App\Http\Controllers\TodoController::class, 'add']);
Route::post('/todo/create',[\App\Http\Controllers\TodoController::class, 'create']);

Route::get('/todo/{task}', [\App\Http\Controllers\TodoController::class, 'edit']);
Route::post('/todo/{task}', [\App\Http\Controllers\TodoController::class, 'update']);
*/

route::name('user.')->group(function () {
    route::view('/ToDo/private', '/ToDo/private')->middleware('auth')->name('private');

    Route::get('/auth/login', function () {
        if(Auth::check()) {
            return redirect(route('user.private'));
        }
        return view('/auth/login');
    })->name('login');

    route::post('/auth/login', [\App\Http\Controllers\LoginController::class, 'login']);

    route::post('/auth/register/changePass/{email}', [RegisterController::class, 'updatePassword'])->name('updatePassword');

    route::get('/auth/logout', function (){
        Auth::logout();
        return redirect(route('home'));
    })->name('logout');

    Route::get('/auth/register', function () {
        if(Auth::check()) {
            return redirect(route('user.private'));
        }
        return view('/auth/register');
    })->name('register');

    Route::post('/auth/register', [RegisterController::class, 'register']);
});


