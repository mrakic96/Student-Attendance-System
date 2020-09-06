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

//Pocetni view - index page
Route::get('/', function () {
    if(Auth::guest()) {
        return view('auth.login');
    } else {
        return view('home');
    }
});

//Auth routes
Auth::routes(['register' => false]);

//Dashboard i korisnicki profil
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');

//Admin panel
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
//    Useri
    Route::resource('/users', 'UsersController', ['except' => 'show']);
    Route::get('/users/administratori', 'UsersController@administratori')->name('users.administratori');
    Route::get('/users/profesori', 'UsersController@profesori')->name('users.profesori');
    Route::get('/users/{user}/profile/', 'UsersController@profile')->name('users.profile');

//    Kolegiji
    Route::resource('/subjects', 'SubjectsController', ['except' => 'show'])->middleware('can:manage-users');
    Route::get('/subjects/{subject}/delete/', 'SubjectsController@delete')->name('subjects.delete');
});

//Predavanja
Route::resource('/attendances', 'AttendancesController', ['except' => 'show'])->middleware('can:manage-attendances');
Route::get('/attendances/createattendance')->name('attendances.createattendance');
Route::put('/attendances/{attendance}/store', 'AttendancesController@storeattendance')->name('attendances.storeattendance');
Route::get('/attendances/{attendance}/editattendance', 'AttendancesController@editattendance')->name('attendances.editattendance');
Route::put('/attendances/{attendance}/updateattendance','AttendancesController@updateattendance')->name('attendances.updateattendance');


//PDF files
Route::get('/pdf-download', 'PDFController@PDFGenerator')->name('pdfdownload');
Route::get('/{user}/pdf-download', 'PDFController@PDFGeneratorAdmin')->name('pdfdownload2');



