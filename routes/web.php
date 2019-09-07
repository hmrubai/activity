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
    Route::get('/getAllOfficer', 'HomeController@getAllOfficer')->name('getAllOfficer');
    Route::post('/saveMeeting', 'MeetingController@store')->name('saveMeeting');
    Route::post('/updateTaskStatus', 'MeetingController@updateTaskStatus')->name('updateTaskStatus');
    Route::get('/assignTask', 'MeetingController@assignTask')->name('assignTask');
    Route::get('/forum', 'ForumController@show')->name('forum');
    Route::post('/assigntaskToEmployee', 'MeetingController@assigntaskToEmployee')->name('assigntaskToEmployee');
    Route::post('/savePost', 'ForumController@savePost')->name('savePost');
    Route::post('/saveComment', 'ForumController@saveComment')->name('saveComment');
    Route::get('/post-details/{post_id}', 'ForumController@postDetails')->name('post-details');
});