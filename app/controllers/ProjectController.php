<?php

class ProjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /project
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /project/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /project
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /project/{id}
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
	 * GET /project/{id}/edit
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
	 * PUT /project/{id}
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
	 * DELETE /project/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function editProjectPage($id) {
		$faculty = Auth::user()->faculty;

		$project = Project::where('id', '=', $id)
			->where('faculty_id','=',$faculty->id)
			->with('students')
			->with('projectAbstract')
			->first();

		if(!$project) {
			return Redirect::route('professor-profile')->withErrors(['message'=>'Not your project']);
		}

		$students = $project->students;

		$student_ids = array();
		$student_regnos = array();

		foreach($students as $student) {
			array_push($student_ids, $student->id);
			array_push($student_regnos, $student->reg_no);
		}
		array_push($student_ids, "");
		array_push($student_regnos, "");

		$student_ids = implode(', ', $student_ids);
		$student_regnos = implode(', ', $student_regnos);

		$info['id'] = $project->id;
		$info['title'] = $project->title;
		$info['abstract'] = $project->project_abstract->abstract;
		$info['type'] = $project->type_id;
		$info['start_date'] = $project->start_date;
		$info['end_date'] = $project->end_date;
		$info['filename'] = $project->filename;
		$info['student_ids'] = $student_ids;
		$info['student_regnos'] = $student_regnos;

		$project_types = ProjectType::all()->toArray();

		return View::make('professor.editProject', array('info'=>$info, 'project_types'=>$project_types));
	}

	public function editProject($id) {
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
			return Redirect::route('professor-edit-project', ['id'=>$id])->withErrors($validator)->withInput();
		}

		if(!Input::hasFile('file')) {
			return Redirect::route('professor-edit-project', ['id'=>$id])->withErrors(['message'=>'No file selected'])->withInput();
		}

		$file = Input::file('file');

		if($file->getSize() > $maxFileSize*1024*1024) {
			return Redirect::route('professor-edit-project', ['id'=>$id])->withErrors(['message'=>'Filesize should be less than '.$maxFileSize.'MB'])->withInput();
		}

		if($file->getClientOriginalExtension() !== 'pdf') {
			return Redirect::route('professor-edit-project', ['id'=>$id])->withErrors(['message'=>'File should be in PDF format'])->withInput();
		}

		
		$info['file_name'] = $faculty->id.'_'.str_replace(' ', '_', $info['title']).'.pdf';

		$filePath = $basePath.'/user_files/faculty/projects/';

		$file->move($filePath, $info['file_name']);

		DB::beginTransaction();

		try {
			$project = Project::find($id);
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

			$abstract = $project->project_abstract;
			$abstract->abstract = $info['abstract'];
			$abstract->project_id = $project->id;

			$abstract->save();

			DB::table('students_has_projects')
				->where('project_id','=',$project->id)
				->delete();
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

	public function showProject($id) {
		$project = Project::with('students', 'projectType', 'projectAbstract', 'mentor')->where('id','=',$id)->first();

		$results = array(
				'id' => $project->id,
				'title' => $project->title,
				'abstract' => $project->project_abstract->abstract,
				'type' => $project->project_type->type,
				'start_date' => $project->start_date,
				'end_date' => $project->end_date,
				'filename' => $project->filename,
				'professor_name' => $project->mentor->firstname.' '.$project->mentor->lastname,
				'professor_id' => $project->mentor->id,
			);
		$results['students'] = $project->students->toArray();

		return View::make('projectProfile', ['data'=>$results]);
	}
}