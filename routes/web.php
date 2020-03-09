<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::get('users', 'UserController')->name('api.users.get');
    Route::get('statuses', 'StatusController')->name('api.statuses.get');
    Route::get('roles', 'RoleController')->name('api.roles.get');
    Route::get('tasks', 'TaskController')->name('api.tasks.get');
});
