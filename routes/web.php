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
/**
 * Home Routes
 */
Route::get('/', function () {
    return view('welcome')->name('home');
});
Route::get('/', 'HomeController@index')->name('Home');
Route::get('/doctors', 'HomeController@doctors')->name('doctors');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/appointment', 'HomeController@appointment')->name('appointment');
Route::get('/submitapp', 'HomeController@submitApp')->name('submitApp');
/**
 * Login Routes
 */
Route::get('/login', function (){
    return view('loginForm');
})->name('login');
Route::get('/loginCheck', 'LoginController@loginCheck')->name('loginCheck');
Route::get('/doctor/{id}', 'LoginController@doctorArea')->name('doctorArea');
/**
 * Register Routes
 */
Route::get('/register', function (){
    return view('registerForm');
})->name('register');
Route::post('/rConfirm', 'RegisterController@rConfirm')->name('rConfirm');
/**
 * Personal Area
 */
Route::get('/user/{id}', 'HomeController@personalArea')->name('personalArea');
Route::get('/seance/{id}', 'HomeController@findSeance')->name('findSeance');
