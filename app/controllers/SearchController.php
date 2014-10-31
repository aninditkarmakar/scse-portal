<?php

class SearchController extends \BaseController {

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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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


	public function searchSubjectName() {
		if(!Input::has('q'))
			return json_encode(array());
		$searchTerm = Input::get('q');

		$s = '%'.$searchTerm.'%';

		$subjects = Subject::where('subject', 'like', $s)
							->select('id','subject as name')
							->get();

		// $subject = DB::table('subjects')
		// 	->select('id', 'title as name')
		// 	->where('subject','like',$s)
		// 	->take(10)
		// 	->get();

		$returnData = array(
				'data' => $subjects,
			);

		return json_encode($returnData);
	}

	public function searchSubjectCode() {
		if(!Input::has('q'))
			return json_encode(array());
		$searchTerm = Input::get('q');

		$s = '%'.$searchTerm.'%';

		$subjects = Subject::where('subject_code', 'like', $s)
							->select('id','subject as name')
							->get();

		// $subject = DB::table('subjects')
		// 	->select('id', 'title as name')
		// 	->where('subject','like',$s)
		// 	->take(10)
		// 	->get();

		$returnData = array(
				'data' => $subjects,
			);

		return json_encode($returnData);
	}

	public function searchProjectTitle() {
		if(!Input::has('q'))
			return json_encode(array());

		$searchTerm = Input::get('q');

		$s = '%'.$searchTerm.'%';

		$projects = Project::with(array(
								'tags',
								'projectType' => function($q) {
									$q->select('id', 'type');
								},
								'mentor' => function($q) {
									$q->select('id', DB::Raw("concat(`firstname`,' ', `lastname`) as name"));
								}
							))
							->orWhere('title','like',$s)
							->select('id', 'title as name', 'type_id', 'faculty_id','start_date', 'end_date')
							->get()
							->each(function($project) {
								$project['project_type'] = $project->projectType->type;
								unset($project->projectType);

								$mentor = $project->mentor->name;
								unset($project->mentor);
								$project['mentor'] = $mentor;

								$tags = $project->tags;
								unset($project->tags);

								$project['tags'] = array();
								
								foreach($tags as $tag) {
									$project['tags'] = array_merge($project['tags'], [$tag['tag']]);
								}
							});

		$returnData = array(
				'data' => $projects,
			);

		return json_encode($returnData);
	}

	public function searchProjectTags() {
		if(!Input::has('q'))
			return json_encode(array());

		$searchTerm = Input::get('q');

		$s = '%'.$searchTerm.'%';

		$projects = Project::whereHas('tags', function($q) use($s) {
								$q->where('tag', 'like', $s);
							})
							->with(array(
								'tags',
								'projectType' => function($q) {
									$q->select('id', 'type');
								},
								'mentor' => function($q) {
									$q->select('id', DB::Raw("concat(`firstname`,' ', `lastname`) as name"));
								}
							))
							->select('id', 'title as name', 'type_id', 'faculty_id','start_date', 'end_date')
							->get()
							->each(function($project) {
								$project['project_type'] = $project->projectType->type;
								unset($project->projectType);

								$mentor = $project->mentor->name;
								unset($project->mentor);
								$project['mentor'] = $mentor;

								$tags = $project->tags;
								unset($project->tags);

								$project['tags'] = array();
								foreach($tags as $tag) {
									$project['tags'] = array_merge($project['tags'], [$tag['tag']]);
								}
							});
		$returnData = array(
				'data' => $projects,
			);

		return json_encode($returnData);
	}

	public function searchFacultyName() {
		if(!Input::has('q'))
			return json_encode(array());

		$searchTerm = Input::get('q');

		$s = '%'.$searchTerm.'%';

		$faculties = Faculty::where('firstname', 'like', $s)
			->orWhere(function($query) use ($s) {
				$query->where('lastname', 'like', $s);
			})
			->select('id', DB::raw("concat(`firstname`, ' ', `lastname`) as name"))
			->take(20)
			->get();

		$returnData = array('data' => $faculties);
		return json_encode($returnData);
	}

	public function searchFacultyCode() {
		if(!Input::has('q'))
			return json_encode(array());

		$searchTerm = Input::get('q');

		$s = $searchTerm.'%';

		$faculties = Faculty::where('faculty_code', 'LIKE', $s)
			->select('id', 'firstname', 'lastname', 'faculty_code')
			->take(20)
			->get();

		$faculties = $faculties->toArray();
		$results = array();

		foreach ($faculties as $faculty) {
			$item['name'] = $faculty['firstname'].' '.$faculty['lastname'].' ('.$faculty['faculty_code'].')';
			$item['id'] = $faculty['id'];
			array_push($results, $item); 
		}

		$returnData = array('data' => $results);
		return json_encode($returnData);
	}

	// public function searchID() {
	// 	$query = DB::table('faculty')
	// 				->select('id', DB::raw("concat(`firstname`, ' ', `lastname`) as name"))
	// 				->take(20);

	// 	if(Input::has('q')) {
	// 		$searchTerm = Input::get('q');
	// 		$query->where('id', '=', $searchTerm);
	// 	}

	// 	$ID = $query->get();

	// 	return json_encode($ID);
	// }

	public function searchPage() {
		return View::make('search');
	}

	public function searchStudentRegNo() {
		if(!Input::has('q'))
			return json_encode(array());

		$searchTerm = Input::get('q').'%';

		
		$students = Student::where('reg_no','like',$searchTerm)->take(5)->get();

		$returnData = array('data'=>$students->toArray());

		return json_encode($returnData);
	}
}
