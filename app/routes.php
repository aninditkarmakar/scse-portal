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

// Route::get('/delete', function() {
// 	$user = User::where('username','like','10010')->firstOrFail();
	
// 	if(!$user->delete())
// 		return 'false';

// 	return 'true';
// });


// Route::get('search/id', array('as' => 'search-id', 'uses' => 'SearchController@searchID'));

Route::group(array('after' => 'json-header'), function() {

	// All routes that require authentication
	Route::group(array('before' => 'auth'), function(){

		Route::group(array('before' => 'auth-admin'), function() {

			// Route::get('testadmin', function() {
			// 	return "admin";
			// });

			Route::resource('admin/add-professor', 'ProfessorController');

		});

		Route::group(array('before' => 'auth-professor'), function() {

			// Route::get('testprofessor', function() {
			// 	return "professor";
			// });

		});

	});

	Route::get('test2', function() {
		$arr = json_decode('[]');
		
		return Response::make(json_encode($arr), 200);
	});

	Route::get('test', function() {
		$fac = Faculty::where('id','=', 2)->with('subjects')->first();
		$semIds = [];

		foreach($fac->subjects as $subject) {
			$subject->setHidden(['pivot', 'id']);
			array_push($semIds, $subject->pivot->semester_id);
		}

		$sems = Semester::whereIn('id', $semIds)->get();

		$semesters = array();

		foreach($sems as $sem) {
			$semesters[$sem->id] = array(
					'name' => $sem->type.' '.$sem->start_year.'-'.$sem->end_year,
					'type' => $sem->type,
					'start' => $sem->start_year,
					'end' => $sem->end_year,
				);
		}

		foreach($fac->subjects as $subject) {
			$subject->semester = $semesters[$subject->pivot->semester_id];
		}

		$queries = DB::getQueryLog();

		return Response::make(json_encode($fac));
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
