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

	public function profilePage($facCode = null) {
		$user = Auth::user();
		$faculty = $user->faculty;

		$data = array(
			'myPage' => true
		);

		if(! $user->isProfessor()) {
			return 'Not Authorized as professor';
		}

		if(! is_null($facCode) && $faculty->id === intval($facCode)) {
			$data['myPage'] = false;
		} else if(! is_null($facCode)) {
			$faculty = Faculty::where('faculty_code', '=', intval($facCode))->first();
		}

		$data['firstName'] = $faculty->firstname;
		$data['lastName'] = $faculty->lastname;
		$data['name'] = $data['firstName'].' '.$data['lastName'];

		$freeSlots = $faculty->getFreeSlots();
		$data['freeSlots'] = $freeSlots;

		$data['specializations'] = $faculty->getSpecializations();

		return View::make('professor.profile')->with('details', $data);
	}

	public function addProfessor() {
		$data['facCode'] = Input::get('fac_code');
		$data['firstName'] = Input::get('first_name');
		$data['lastName'] = Input::get('last_name');
		$data['email'] = Input::get('email');
		$data['cabin'] = Input::get('cabin');

		$rules = array(
			'facCode' => 'required|digits:5|unique:faculties,faculty_code',
			'firstName' => 'required|alpha',
			'lastName' => 'required|alpha',
			'email' => 'required|unique:users,email',
			'cabin' => 'required|alpha_dash',
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
		$faculty->cabin = strtoupper($data['cabin']);

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
			$returnData['message'] = $e->getMessage();
			return Response::make(json_encode($returnData), 400)->header('Content-Type', 'application/json');
		} 

		DB::connection()->getPdo()->commit();

		$returnData['success'] = true;
		return Response::make(json_encode($returnData), 200)->header('Content-Type', 'application/json');
	}
}