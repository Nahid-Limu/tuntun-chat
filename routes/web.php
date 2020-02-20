<?php

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
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/chat', 'ChatController@index')->name('chat');
    Route::post('/chat', 'ChatController@sentMsg')->name('sentMsg');
    Route::get('/reciverid', 'ChatController@chatReciverId')->name('reciverid');

    Route::get('/profile', 'ProfileController@profile')->name('profile');
    Route::post('/profile', 'ProfileController@Updateprofile')->name('Updateprofile');
    
    Route::get('/requestList', 'FriendReqestController@requestList')->name('requestList');

    Route::get('/userlogout/{id}', 'ChatController@logout')->name('userlogout');
});

// Route::get('/test', function () {
//     return view('requestList');
// });

