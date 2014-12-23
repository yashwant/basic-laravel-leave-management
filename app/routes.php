<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

/**
 * Groups of routes that don't need authentication to access.
 */
Route::get('login', array('as' => 'login', 'uses' => 'UsersController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UsersController@handleLogin'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));
Route::group(array('before' => 'auth'), function() {
    Route::get('/', function() {
        return View::make('hello');
    });
    Route::resource('user', 'UsersController');
});

/**
 * Groups of routes that need authentication to access.
 */
Route::group(array('before' => 'auth'), function() {
    Route::get('/profile', array('as' => 'profile', 'uses' => 'UsersController@profile'));
    Route::get('/leave12', array('as' => 'leave_show', 'uses' => 'LeavesController@show'));
    Route::get('/admin/leave/pending', array('as' => 'admin_leave_pening', 'uses' => 'LeavemanagementController@index'));
    Route::get('/leave/approve/{leave}', array('as' => 'leave_approve', 'uses' => 'LeavemanagementController@approve'), function(Leave $leave) {
        return $leave;
    });
    Route::get('/leave/reject/{leave}', array('as' => 'leave_reject', 'uses' => 'LeavemanagementController@reject'), function(Leave $leave) {
        return $leave;
    });
    Route::model('leave', 'Leave');
    Route::resource('leave', 'LeavesController');
    Route::model('leavemanagement', 'Leavemanagement');
    Route::resource('leavemanagement', 'LeavemanagementController');
    Route::get('leave/status/{leave}', array('as' => 'leave_status', 'uses' => 'LeavesController@status'), function(Leave $leave) {
        return $leave;
    });

});

