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


	public function addStudent()
	{
		$data['reg_no'] = Input::get('reg_no');
		$data['firstName'] = Input::get('first_name');
		$data['lastName'] = Input::get('last_name');
		$data['email'] = Input::get('email');

		// Validation rules
		$rules = array(
			'firstName' => 'required',
			'lastName' => 'required',
			'reg_no' => 'required|unique:students',
			'email' => 'required|email|unique:students',
			);

		$messages = array(
			'reg_no.unique' => 'The student registration number already exists!',
			);

		// Do validation
		$validator = Validator::make($data, $rules);


		if($validator->fails()) {
			return Redirect::route('add-student')->withErrors($validator)->withInput();
		}

		$student = new Student();
		$student->firstname = $data['firstName'];
		$student->lastname = $data['lastName'];
		$student->reg_no = strtoupper($data['reg_no']);
		$student->email = $data['email'];

		try {
				DB::connection()->getPdo()->beginTransaction();

				if(! $student->save()) {
					$errors['message'] = 'There was an error saving the details. Please try again.';

					return Redirect::route('add-student')->withErrors($errors)->withInput();
				}
				DB::connection()->getPdo()->commit();
		} catch (\PDOException $e) {
			 DB::connection()->getPdo()->rollBack();
			 $errors['message'] = 'There was an error saving the details. Please try again.';
			 return Redirect::route('add-student')->withErrors($errors)->withInput();
		}
		

		// make the return data
		$returnData['success'] = true;
		$returnData['student'] = array(
				'id' => $student->id,
				'firstname' => ucfirst($student->firstname),
				'lastname' => ucfirst($student->lastname),
				'name' => ucfirst($student->firstname).' '.ucfirst($student->lastname),
				'reg_no' => $student->reg_no,
				'email' => $student->email,
			);
		

		// return Response::make(json_encode($returnData), 200);

		return Redirect::route('add-student')->with('success', $returnData['success']);;
	}

	public function showProfileRegNo($regNo) {
		$student = Student::with('projects.projectType', 'projects.projectAbstract', 'projects.students')->where('reg_no', 'like', $regNo)->first();

		$results = array();

		$results['id'] = $student->id;
		$results['name'] = $student->firstname.' '.$student->lastname;
		$results['reg_no'] = $student->reg_no;
		$results['email'] = $student->email;
		$results['projects'] = array();

		foreach($student->projects as $project) {
			$item['id'] = $project->id;
			$item['title'] = $project->title;
			$item['abstract'] = $project->project_abstract->abstract;
			$item['type'] = $project->project_type->type;
			$item['start_date'] = $project->start_date;
			$item['end_date'] = $project->end_date;
			$item['filename'] = $project->filename;
			$item['students'] = $project->students->toArray();

			array_push($results['projects'], $item);

		}

		return View::make('studentProfile', array('data'=>$results));
	}
}
