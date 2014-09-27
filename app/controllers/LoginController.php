<?php

class LoginController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('login');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Get the raw JSON payload
		$credentials = Request::instance()->getContent();
		$credentials = json_decode($credentials, true);

		$returnData = array(
				'success' => false,
			);

		if(isset($credentials['username']) && isset($credentials['password'])) {
			$creds = array('username'=>$credentials['username'], 'password'=>$credentials['password']);
		} else {
			$returnData['message'] = 'What are you trying?';

			return Response::make(json_encode($returnData), 400);
		}

		if(Auth::attempt($creds)) {
			$returnData['success'] = true;
			$returnData['sessionId'] = Session::get('_token');
			$returnData['user'] = array();

			$user = Auth::user();
			$returnData['user']['id'] = $user->id;
			$returnData['user']['username'] = $user->username;
			$returnData['user']['password_changed'] = $user->init_password !== null ? false:true;
			$returnData['user']['roles'] = array();


			foreach($user->roles as $role) {
				array_push($returnData['user']['roles'], $role['role']);
			}

			return Response::make(json_encode($returnData), 200);
			
		} else {
			$returnData['message'] = 'Incorrect Credentials';

			return Response::make(json_encode($returnData), 400);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function logout() {
		Auth::logout();

		$returnData['success'] = true;

		return Response::make(json_encode($returnData), 200);
	}

}
