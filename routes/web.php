<?php

use Illuminate\Support\Facades\Route;
use App\setting;

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
 $setting=setting::where('id',1)->first();
    return view('auth.login',compact('setting'));
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/beranda', 'beranda_controller');
    Route::resource('admin/user', 'user_controller');
    Route::get('admin/json','user_controller@json');
    Route::patch('admin/user/update/{id}', 'user_controller@update');
    Route::get('admin/profile','Profile_controller@index')->name('view.profile');
    Route::patch('admin/profile/update', 'Profile_controller@update');
    Route::post('admin/profile/store', 'Profile_controller@store')->name('profile.store');
    Route::resource('admin/setting', 'setting_controller');
    Route::patch('admin/detail','setting_controller@store')->name('setting.detail');
    Route::patch('admin/icon','setting_controller@icon')->name('setting.icon');
    Route::patch('admin/logo','setting_controller@logo')->name('setting.logo');


    // Route::patch('admin/user/update/{id}', 'user_controller@update');
    // Route::get('admin/user/delete/{id}', 'user_controller@destroy');
    // Route::resource('admin/profile', 'profile_controller');
    // Route::patch('admin/profile/update', 'user_controller@update');
});

Auth::routes(['register'=> false, 'reset'=>false]); 
Route::get('/logout', function () {
    Auth::logout();
        return redirect('/');
    });

Route::get('/home', function () {
    return redirect('admin/beranda');
});