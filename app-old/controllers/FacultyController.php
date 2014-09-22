<?php

class FacultyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('authorized.faculty.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array(
			'firstname' => Input::get('firstname'),
			'lastname' => Input::get('lastname'),
			'faculty_code' => Input::get('faculty_code'),
			'email' => Input::get('email'),
			'cabin' => Input::get('cabin'),
			'password' => Input::get('password'),
		);

		$rules = array(
			'firstname' => 'required',
			'lastname' => 'required',
			'faculty_code' => 'required|integer|unique:faculty',
			'email' => 'required|email|unique:faculty',
			'password' => 'required',
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails()) {
			return Redirect::route('faculty.create')->withErrors($validator);
		}

		$faculty = new User();

		$faculty->firstname = $input['firstname'];
		$faculty->lastname = $input['lastname'];
		$faculty->faculty_code = $input['faculty_code'];
		$faculty->email = $input['email'];
		$faculty->cabin = $input['cabin'];
		$faculty->password = Hash::make($input['password']);

		$faculty->save();

		return Redirect::route('dashboard')->with('message', 'Faculty Added Successfully');
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


}
