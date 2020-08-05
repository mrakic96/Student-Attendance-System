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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){

    Route::resource('/users', 'UsersController', ['except' => 'show']);
    Route::get('/users/administratori', 'UsersController@administratori')->name('users.administratori');
    Route::get('/users/profesori', 'UsersController@profesori')->name('users.profesori');
    Route::resource('/subjects', 'SubjectsController', ['except' => 'show']);

});

Route::resource('/attendances', 'AttendancesController', ['except' => 'show'])->middleware('can:manage-attendances');
Route::get('/attendances/{attendance}/editattendance', 'AttendancesController@editattendance')->name('attendances.editattendance');
Route::put('/attendances/{attendance}/update', 'AttendancesController@updateattendance')->name('attendances.updateattendance');



