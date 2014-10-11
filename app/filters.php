<?php

function unauthorizedResponse() {
	$returnData = array(
		"success" => false,
		"message" => 'Unauthorized',
		);

	return Response::make(json_encode($returnData), 401);
}

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::missing(function($exception) {
	$returnData['success'] = false;
	$returnData['message'] = "URL Not Found!";
	return Response::make(json_encode($returnData), 404)->header('Content-Type', 'application/json');
});

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
	$response->headers->set('Access-Control-Allow-Origin', 'http://127.0.0.1:9000');
	$response->headers->set('Allow', 'GET,HEAD,POST,OPTIONS');
	$response->headers->set('Access-Control-Allow-Credentials', 'true');
	$response->headers->set('Access-Control-Allow-Headers', 'X-Requested-With, content-type, access, accept, X-Custom-Header');
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		return unauthorizedResponse();
	}
});

Route::filter('auth-admin', function() {
	// $returnData = array(
	// 	"success" => false,
	// 	"message" => 'Unauthorized',
	// 	);

	if (Auth::guest())
	{
		return unauthorizedResponse();
	} else {
		$user = Auth::user();
		$flag = 0;
		foreach($user->roles as $role) {
			if($role['role'] === 'admin') {
				$flag = 1;
				break;
			}
		}

		if($flag === 0) {
			return unauthorizedResponse();
		} 
	}

});

Route::filter('auth-professor', function() {
	if (Auth::guest())
	{
		return unauthorizedResponse();
	} else {
		$user = Auth::user();
		$flag = 0;
		foreach($user->roles as $role) {
			if($role['role'] === 'professor') {
				$flag = 1;
				break;
			}
		}

		if($flag === 0) {
			return unauthorizedResponse();
		} 
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('json-header', function($route, $request, $response) {
	$response->headers->set('Content-Type', 'application/json');
});
