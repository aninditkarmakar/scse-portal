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

Route::get('/', function()
{
	return View::make('home');
});

Route::get('test', function() {
	return "hello";
});


// All routes that require authentication
Route::group(array('before' => 'auth'), function(){


	Route::get('dashboard', array('as' => 'dashboard', function() {
		return View::make('authorized.dashboard');
	}));


	Route::get('logout', array('as' => 'logout', function() {
		Auth::logout();
		return Redirect::route('login.index');
	}));

	Route::resource('student', 'StudentController');

	Route::resource('faculty', 'FacultyController');

});

Route::resource('login', 'LoginController');

Route::get('search/projects', array('as' => 'search-projects', 'uses' => 'SearchController@searchProjects'));

Route::get('search/faculty', array('as' => 'search-faculty', 'uses' => 'SearchController@searchFaculty'));
