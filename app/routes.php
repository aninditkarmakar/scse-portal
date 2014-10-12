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

Route::group(array('before' => 'auth'), function() {

});

Route::get('/', array('as' => 'home', function() {
	return View::make('home');
}));

Route::group(array('before'=>'auth'), function() {
	Route::group(array('before'=>'auth-admin', 'prefix'=>'admin'), function() {

		Route::get('/', array('as'=>'admin-dashboard','uses'=>'AdminController@landingPage'));
		Route::get('add-professor', array('as'=>'add-professor', 'uses'=>'AdminController@addProfessorPage'));
		Route::post('add-professor', array('as'=>'add-professor-post', 'uses'=>'ProfessorController@addProfessor'));
		

		Route::get('delete-professor/{id}', function($id) {
			User::where('username','=',$id)->first()->delete();
			return 'true';
		});
	});

	Route::group(array('before'=>'auth-professor', 'prefix'=>'professor'), function() {

		Route::get('/', array('as'=>'professor-profile', 'uses'=>'ProfessorController@profilePage'));
		Route::get('edit', array('as'=>'professor-profile-edit', 'uses'=>'ProfessorController@editPage'));
		Route::post('edit', array('as'=>'professor-edit-post', 'uses'=>'ProfessorController@doEdit'));
	});
});

Route::get('login', array('as'=>'login-page', 'uses'=>'LoginController@loginPage'));
Route::post('login', array('as'=>'login-post', 'uses'=>'LoginController@doLogin'));

Route::get('logout', array('as'=>'logout', 'uses'=>'LoginController@doLogout'));

Route::get('search', array('as'=>'search', 'uses'=>'SearchController@searchPage'));



//--------------------------------------------------------------------------------------------------------------


/**
 * ------------------------------------------API -------------------------
 */
Route::group(array('after' => 'json-header', 'prefix'=>'api'), function() {

	// All routes that require authentication
	Route::group(array('before' => 'api-auth'), function(){

		Route::group(array('before' => 'api-auth-admin'), function() {

			// Route::get('testadmin', function() {
			// 	return "admin";
			// });

			Route::resource('admin/add-professor', 'ProfessorController');

		});

		Route::group(array('before' => 'api-auth-professor'), function() {

			// Route::get('testprofessor', function() {
			// 	return "professor";
			// });
			Route::pattern('facCode', '[0-9]+');
			Route::post('professor/{facCode}/modify/{type}', array('as' => 'modify-professor', 'uses' => 'ProfessorController@modify'));

		});

	});

	Route::get('logout', array('as' => 'api-logout', 'uses' => 'LoginController@logout'));

	Route::resource('login', 'LoginController');
	
	Route::get('search/faculty-name', array('as' => 'search-faculty-name', 'uses' => 'SearchController@searchFacultyName'));

	Route::get('search/faculty-code', array('as' => 'search-faculty-code', 'uses' => 'SearchController@searchFacultyCode'));

	Route::get('search/project-title', array('as' => 'search-project-title', 'uses' => 'SearchController@searchProjectTitle'));

	Route::get('search/project-tags', array('as' => 'search-project-tags', 'uses' => 'SearchController@searchProjectTags'));

	Route::get('search/subject-name', array('as' => 'search-subject-name', 'uses' => 'SearchController@searchSubjectName'));

	Route::get('search/subject-code', array('as' => 'search-subject-code', 'uses' => 'SearchController@searchSubjectCode'));

});
