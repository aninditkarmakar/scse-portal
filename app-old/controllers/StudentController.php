<?php

class StudentController extends \BaseController {

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
		return View::make('authorized.student.create');
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
			'reg_no' => Input::get('reg_no'),
			'email' => Input::get('email'),
		);

		$rules = array(
			'firstname' => 'required',
			'lastname' => 'required',
			'reg_no' => 'required|unique:student',
			'email' => 'required|email|unique:student',
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails()) {
			return Redirect::route('student.create')->withErrors($validator);
		}

		$student = new Student();

		$student->firstname = $input['firstname'];
		$student->lastname = $input['lastname'];
		$student->reg_no = strtoupper($input['reg_no']);
		$student->email = $input['email'];

		$student->save();

		return Redirect::route('dashboard')->with('message', 'Student Added Successfully');
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
