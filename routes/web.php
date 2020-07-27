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
    return view('landing');
});

Auth::routes();

Route::get('/account', 'HomeController@index')->name('home');
Route::patch('/account/update_profile/{user}', 'ProfileController@update')->name('save_account_changes');
Route::patch('/account/update_teacher_profile/{profile}','ProfileController@create')->name('teacher_account_upgrade');

Route::get('/account/validate/teachers','TeachersController@show')->name('validate_teachers')->middleware(['auth','admin']);
Route::get('/account/validated/teachers','TeachersController@index')->name('validated_teachers')->middleware('auth','admin');
Route::get('/account/validate/teachers/approve/{teacher}','TeachersController@update')->name('teacher.approve')->middleware(['auth','admin']);
Route::patch('/account/validated/teachers/update/{teacher}','TeachersController@store')->name('teacher_account_update')->middleware(['auth','admin']);
Route::get('/account/teacher/class/new/{user}','ClassController@store')->name('newClass')->middleware('auth','teacher');
Route::post('/account/teacher/class/new','ClassController@create')->name('save_class')->middleware(['auth','teacher']);
Route::get('/account/teacher/class/list/{user}','ClassController@index')->name('myClasses')->middleware(['auth','teacher']);
Route::patch('/account/class/update/{clas}','ClassController@update')->name('updateClass')->middleware(['auth','teacher']);
Route::delete('/account/class/update/{clas}','ClassController@delete')->name('deleteClass')->middleware(['auth','teacher']);
Route::get('/account/class_lists','ClassController@fetch')->name('ClassLists'); 