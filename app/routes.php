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

Route::get('/', array('as'=>'home', function()
{
	return View::make('home');
}));

Route::get('/delete', function() {
	$user = User::where('username','like','10010')->firstOrFail();
	
	if(!$user->delete())
		return 'false';

	return 'true';
});


// Route::get('search/id', array('as' => 'search-id', 'uses' => 'SearchController@searchID'));

Route::group(array('after' => 'json-header'), function() {

	// All routes that require authentication
	Route::group(array('before' => 'auth', 'after' => 'json-header'), function(){

		Route::group(array('before' => 'auth-admin'), function() {

			Route::get('testadmin', function() {
				return "admin";
			});

			Route::resource('admin/add-professor', 'ProfessorController');

		});

		Route::group(array('before' => 'auth-professor'), function() {

			Route::get('testprofessor', function() {
				return "professor";
			});

		});

	});

	Route::get('logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));

	Route::resource('login', 'LoginController');
	
	Route::get('search/faculty-name', array('as' => 'search-faculty-name', 'uses' => 'SearchController@searchFacultyName'));

	Route::get('search/faculty-code', array('as' => 'search-faculty-code', 'uses' => 'SearchController@searchFacultyCode'));

	Route::get('search/project-title', array('as' => 'search-project-title', 'uses' => 'SearchController@searchProjectTitle'));

	Route::get('search/project-tags', array('as' => 'search-project-tags', 'uses' => 'SearchController@searchProjectTags'));

	Route::get('search/subject-name', array('as' => 'search-subject-name', 'uses' => 'SearchController@searchSubjectName'));

	Route::get('search/subject-code', array('as' => 'search-subject-code', 'uses' => 'SearchController@searchSubjectCode'));

});
