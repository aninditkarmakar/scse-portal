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

	public function modify($facCode, $type) {
		$faculty = Auth::user()->faculty;
		$facCode = intval($facCode);
		
		$returnData['success'] = false;

		// Verify facCode is same as current user's
		if($faculty->faculty_code !== $facCode) {
			$returnData['message'] = 'You are not who you are!';
			return Response::make(json_encode($returnData), 400);
		}

		// check what to modify
		switch ($type) {
			case 'name':
				$this->modifyFacultyName($faculty);
				break;

			case 'free-slot':
				$this->modifyFacultyFreeSlot($faculty);
				break;
			
			default:
				case 'cabin-number':
				$this->modifyFacultyCabin($faculty);
				break;
		}
	}

	public function modifyFacultyName($faculty) {

	}

	public function modifyFacultyFreeSlot($faculty) {

	}

	public function modifyFacultyCabin($faculty) {
		
	}

	public function profilePage($id = null) {
		$faculty = null;
		$user = null;

		$data = array(
			'myPage' => false
		);

		if($id !== null) {
			$faculty = Faculty::find($id);
			$user = $faculty->user;

			if(Auth::check()) {
				if(Auth::user()->faculty->id === intval($id)) {
					$data['myPage'] = true;
				}
			}
		} else {
			$user = Auth::user();
			$faculty = $user->faculty;

			if(! $user->isProfessor()) {
				return 'Not Authorized as professor';
			}

			$data['myPage'] = true;
			// if(($faculty->id === )!is_null($id) && $faculty->id === intval($id)) {
			// 	$data['myPage'] = true;
			// } else {
			// 	$data['myPage'] = false;
			// }
		}

		$data['id'] = $faculty->id;
		$data['firstName'] = $faculty->firstname;
		$data['lastName'] = $faculty->lastname;
		$data['name'] = $data['firstName'].' '.$data['lastName'];
		$data['email'] = $user->email;

		$freeSlots = $faculty->getFreeSlots();
		$data['freeSlots'] = $freeSlots;
		$data['specializations'] = $faculty->getSpecializations();

		$data['designation'] = $faculty->designation;
		$data['about_me'] = $faculty->about_me;
		$data['mobile_no'] = $faculty->mobile_no;

		$projects = Project::with('projectAbstract', 'students', 'projectType')->where('faculty_id','=',$faculty->id)->get();


		$data['projects'] = $projects->toArray();

		return View::make('professor.profile')->with('details', $data);
	}

	public function addProfessor() {
		$data['facCode'] = Input::get('fac_code');
		$data['firstName'] = Input::get('first_name');
		$data['lastName'] = Input::get('last_name');
		$data['email'] = Input::get('email');
		$data['building'] = Input::get('building');
		$data['room'] = Input::get('room');
		$data['cabin'] = Input::get('cabin');
		$data['designation'] = Input::get('designation');
		$data['mobile_no'] = Input::get('mobile_no');

		$rules = array(
			'facCode' => 'required|digits:5|unique:faculties,faculty_code',
			'firstName' => 'required|alpha',
			'lastName' => 'required|alpha',
			'email' => 'required|unique:users,email',
			'cabin' => 'required|alpha_dash',
			'designation' => 'required',
			'mobile_no' => 'required|numeric|digits:10',
			'building' => 'required',
			'room' => 'required'
			);

		$messages = array(
			'facCode.unique' => 'The faculty code already exists!',
			);

		// Do validation
		$validator = Validator::make($data, $rules, $messages);

		if($validator->fails()) {
			return Redirect::route('add-professor')->withErrors($validator)->withInput();
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
		$faculty->cabin = strtoupper($data['building'].' '.$data['room'].'-'.$data['cabin']);
		$faculty->designation = $data['designation'];
		$faculty->mobile_no = $data['mobile_no'];

		try {
				DB::connection()->getPdo()->beginTransaction();
				if(! $user->save()) {
					$errors['message'] = 'There was an error saving the details. Please try again.';

					return Redirect::route('add-professor')->withErrors($errors)->withInput();
				}

				if(! $user->roles()->save($role)) {
					$errors['message'] = 'There was an error saving the details. Please try again.';
					
					$user->delete();

					return Redirect::route('add-professor')->withErrors($errors)->withInput();
				}

				$faculty->user()->associate($user);

				if(! $faculty->save()) {
					$errors['message'] = 'There was an error saving the details. Please try again.';

					$user->delete();

					return Redirect::route('add-professor')->withErrors($errors)->withInput();
				}
				DB::connection()->getPdo()->commit();
		} catch (\PDOException $e) {
			 DB::connection()->getPdo()->rollBack();
			 $errors['message'] = 'There was an error saving the details. Please try again.';
			 return Redirect::route('add-professor')->withErrors($errors)->withInput();
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

		// return Response::make(json_encode($returnData), 200);

		return Redirect::route('add-professor')->with('credentials', $returnData['user']);
	}

	public function editPage() {
		$faculty = Auth::user()->faculty;

		$data['firstName'] = $faculty->firstname;
		$data['lastName'] = $faculty->lastname;
		$data['name'] = $data['firstName'].' '.$data['lastName'];
		$data['cabin'] = $faculty->cabin;
		$data['mobile_no'] = $faculty->mobile_no;
		$data['about_me'] = $faculty->about_me;

		$freeSlots = $faculty->getFreeSlots();
		$data['freeSlots'] = $freeSlots;

		$data['specializations'] = $faculty->getSpecializations();

		return View::make('professor.edit')->with('details', $data);
	}

	public function doEdit() {
		$returnData['success'] = false;
		$input = json_decode(Input::get('data'), true);

		$faculty = Auth::user()->faculty;

		if(isset($input['firstName'])) {
			$faculty->firstname = $input['firstName'];
		}

		if(isset($input['lastName'])) {
			$faculty->lastName = $input['lastName'];
		}
		
		if(!isset($input['freeSlots']) || !isset($input['specializations'])) {
			return Response::make(json_encode($returnData), 400)->header('Content-Type', 'application/json');
		}

		if(!isset($input['cabin'])) {
			return Response::make(json_encode($returnData), 400)->header('Content-Type', 'application/json');
		} else {
			$faculty->cabin = $input['cabin'];
		}

		if(isset($input['about_me'])) {
			$faculty->about_me = $input['about_me'];
		}

		if(isset($input['mobile_no'])) {
			$faculty->mobile_no = $input['mobile_no'];
		}

		DB::connection()->getPdo()->beginTransaction();

		try{
			$faculty->freeSlots()->delete();
			$faculty->specializations()->delete();

			foreach ($input['freeSlots'] as $fs) {
				$slot = new FacultySlot();
				$slot->day = $fs['day'];
				$slot->from_time = $fs['from'];
				$slot->to_time = $fs['to'];
				$slot->faculty()->associate($faculty);
				$slot->save();
			}

			foreach ($input['specializations'] as $spec) {
				$sp = new Specialization();
				$sp->specialization = $spec['value'];
				$sp->faculty()->associate($faculty);
				$sp->save();
			}

			$faculty->save();
		} catch(\PDOException $e) {
			DB::connection()->getPdo()->rollback();
			$returnData['message'] = $e->getMessage();
			return Response::make(json_encode($returnData), 400)->header('Content-Type', 'application/json');
		} 

		DB::connection()->getPdo()->commit();

		$returnData['success'] = true;
		return Response::make(json_encode($returnData), 200)->header('Content-Type', 'application/json');
	}

	public function showAddProjectPage() {
		$projectTypes = ProjectType::all()->toArray();

		return View::make('professor.addProject', array('project_types'=>$projectTypes));
	}

	public function addProject() {
		$basePath = base_path();
		$faculty = Auth::user()->faculty;
		$maxFileSize = 10; //MB

		$info['title'] = Input::get('title');
		$info['abstract'] = Input::get('abstract');
		$info['student_ids'] = explode(', ',Input::get('student_ids'));
		
		array_pop($info['student_ids']);

		$info['type'] = Input::get('type');
		$info['start_date'] = Input::get('start_date');
		$info['end_date'] = Input::get('end_date');

		$rules = array(
				'title'=>'required',
				'abstract'=>'required',
				'student_ids' => 'required',
				'type'=>'required',
				'start_date' => 'required',
				'end_date' => 'required',
			);
		$validator = Validator::make($info, $rules);

		if($validator->fails()) {
			return Redirect::route('professor-add-project')->withErrors($validator)->withInput();
		}

		if(!Input::hasFile('file')) {
			return Redirect::route('professor-add-project')->withErrors(['message'=>'No file selected'])->withInput();
		}

		$file = Input::file('file');

		if($file->getSize() > $maxFileSize*1024*1024) {
			return Redirect::route('professor-add-project')->withErrors(['message'=>'Filesize should be less than '.$maxFileSize.'MB'])->withInput();
		}

		if($file->getClientOriginalExtension() !== 'pdf') {
			return Redirect::route('professor-add-project')->withErrors(['message'=>'File should be in PDF format'])->withInput();
		}

		
		$info['file_name'] = $faculty->id.'_'.str_replace(' ', '_', $info['title']).'.pdf';

		$filePath = $basePath.'/user_files/faculty/projects/';

		$file->move($filePath, $info['file_name']);

		DB::beginTransaction();

		try {
			$project = new Project();
			$project->title = $info['title'];
			$project->type_id = $info['type'];
			$project->faculty_id = $faculty->id;
			$project->start_date = $info['start_date'];
			$project->end_date = $info['end_date'];
			$project->filename = $info['file_name'];

			$project->save();

			$pivotInfo = array();
			foreach($info['student_ids'] as $id) {
				array_push($pivotInfo, array('student_id'=>intval($id), 'project_id'=>$project->id));
			}

			$abstract = new ProjectAbstract();
			$abstract->abstract = $info['abstract'];
			$abstract->project_id = $project->id;

			$abstract->save();		

			if((count($pivotInfo)>0)) {				
				DB::table('students_has_projects')->insert($pivotInfo);
			}
		} catch(\Exception $e) {
			DB::rollback();
			dd($e->getMessage());
		}

		DB::commit();

		return Redirect::route('professor-profile');
	}

	public function deleteProject($id) {
		$project = Project::find($id);
		$faculty = Auth::user()->faculty;

		if(intval($project->faculty_id) !== $faculty->id) {
			return Redirect::route('professor-profile')->withErrors(['message'=>'That is not your project!']);
		}

		DB::beginTransaction();

		try {
			$project->project_abstract->delete();
			$project->students()->delete();
			$project->tags()->delete();
			$project->delete();
		} catch (\PDOException $e) {
			DB::rollback();
			return Redirect::route('professor-edit-project', array('id'=>$project->id))->withErrors(['message'=>'There was an error deleting the project.']);
		}

		DB::commit();
		
		return Redirect::route('professor-profile');
	}
}