<?php

Route::get('/', 'Auth\AuthController@login')->name('login');

Route::get('/logout', function(){
    Session::flush();
    Auth::logout();
    return Redirect::to("/login")
      ->with('message', array('type' => 'success', 'text' => 'You have successfully logged out'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/entryActivity', 'HomeController@entryDailyActivity')->name('entryActivity');
    Route::get('/getAllList', 'DailyActivityController@getAllList')->name('getAllList');
    Route::post('/saveDailyActivity', 'DailyActivityController@saveDailyActivity')->name('saveDailyActivity');
    Route::get('/meetingList', 'MeetingController@index')->name('meetingList');
    Route::post('/saveMeeting', 'MeetingController@store')->name('saveMeeting');
});