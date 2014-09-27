<?php

use Faker\Factory as Faker;

class ProfessorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /professor
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /professor/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /professor
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = json_decode(Request::instance()->getContent(),true);
		$returnData = array(
			"success" => false,
			);

		if(!isset($data['professor'])) {
			$returnData['message'] = "Invalid Format";

			return Response::make(json_encode($returnData), 400);
		}

		$data = $data['professor'];

		// Validation rules
		$rules = array(
			'facCode' => 'required|digits:5|unique:faculties,faculty_code',
			'firstName' => 'required|alpha',
			'lastName' => 'required|alpha',
			'email' => 'required|unique:users,email',
			'cabin' => 'required|alpha_dash',
			);

		// Do validation
		$validator = Validator::make($data, $rules);

		if($validator->fails()) {
			$returnData['message'] = $validator->messages()->first();

			return Response::make(json_encode($returnData), 400);
		}

		$faker = Faker::create();

		// get the 'professor' role
		$role = Role::where('role', 'like', 'professor')->firstOrFail();

		// create a new user
		$user = new User();
		$user->email = $data['email'];
		$user->username = strval($data['facCode']);
		$user->init_password = $faker->bothify('??#?##????#');
		$user->password = Hash::make($user->init_password);

		// create a new faculty
		$faculty = new Faculty();
		$faculty->firstname = ucfirst($data['firstName']);
		$faculty->lastname = ucfirst($data['lastName']);
		$faculty->faculty_code = $data['facCode'];
		$faculty->cabin = strtoupper($data['cabin']);


		if(! $user->save()) {
			$returnData['message'] = 'There was an error saving the details. Please try again.';

			return Response::make(json_encode($returnData), 400);
		}

		if(! $user->roles()->save($role)) {
			$returnData['message'] = 'There was an error saving the details. Please try again.';
			
			$user->delete();

			return Response::make(json_encode($returnData), 400);
		}

		$faculty->user()->associate($user);

		if(! $faculty->save()) {
			$returnData['message'] = 'There was an error saving the details. Please try again.';

			$user->delete();

			return Response::make(json_encode($returnData), 400);
		}

		// make the return data
		$returnData['success'] = true;
		$returnData['professor'] = array(
				'id' => $faculty->id,
				'firstname' => ucfirst($faculty->firstname),
				'lastname' => ucfirst($faculty->lastname),
				'name' => ucfirst($faculty->firstname).' '.ucfirst($faculty->lastname),
				'faculty_code' => $faculty->faculty_code,
				'cabin' => $faculty->cabin,
				'email' => $user->email,
			);
		$returnData['user'] = array(
				'id' => $user->id,
				'username' => $user->username,
				'password' => $user->init_password,
				'roles' => ['professor'],
			);

		return Response::make(json_encode($returnData), 200);
	}

	/**
	 * Display the specified resource.
	 * GET /professor/{id}
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
	 * GET /professor/{id}/edit
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
	 * PUT /professor/{id}
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
	 * DELETE /professor/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}