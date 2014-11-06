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
		$info['abstract'] = nl2br($project->project_abstract->abstract);
		$info['type'] = $project->type_id;
		$info['start_date'] = $project->start_date;
		$info['end_date'] = $project->end_date;
		$info['filename'] = $project->filename;
		$info['student_ids'] = $student_ids;
		$info['student_regnos'] = $student_regnos;
		$info['semester_id'] = $project->semester_id;

		$project_types = ProjectType::all()->toArray();

		$sem_list = DB::table('semesters')->select('id','type', 'start_year', 'end_year')->orderBy('start_year','desc')->remember(10)->get();
		$semester_list = [];

		foreach($sem_list as $semester) {
			$semester_list[$semester->id] = $semester->type.' '.$semester->start_year.'-'.$semester->end_year;
			// $item = [];
			// $item['name'] = 
			// $item['id'] = $semester->id;

			// array_push($semester_list, $item);
		}

		return View::make('professor.editProject', array('info'=>$info, 'project_types'=>$project_types, 'semester_list'=>$semester_list));
	}

	public function editProject($id) {
		$basePath = base_path();
		$faculty = Auth::user()->faculty;
		$maxFileSize = 10; //MB

		$info['title'] = Input::get('title');
		$info['abstract'] = Input::get('abstract');
		$info['student_ids'] = explode(', ',Input::get('student_ids'));
		$info['semester_id'] = Input::get('semester_id');
		
		array_pop($info['student_ids']);

		$info['type'] = Input::get('type');
		$info['start_date'] = Input::get('start_date');
		$info['end_date'] = Input::get('end_date');
		$info['file_uploaded'] = intval(Input::get('file_uploaded'));

		$rules = array(
				'title'=>'required',
				'abstract'=>'required',
				'student_ids' => 'required',
				'type'=>'required',
				'start_date' => 'required',
				'semester_id' => 'required|numeric',
				//'end_date' => 'required',
			);
		$validator = Validator::make($info, $rules);
		$file = null;

		if($validator->fails()) {
			return Redirect::route('professor-edit-project', ['id'=>$id])->withErrors($validator)->withInput();
		}

		if($info['file_uploaded'] === 0) {
			if(!Input::hasFile('file')) {
				return Redirect::route('professor-edit-project', ['id'=>$id])->withErrors(['message'=>'Please upload a PDF file!'])->withInput();
			} else {
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
			}
		} else {
			if(Input::hasFile('file')) {
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
			}			
		}

		DB::beginTransaction();

		try {
			$project = Project::find($id);
			$project->title = $info['title'];
			$project->type_id = $info['type'];
			$project->faculty_id = $faculty->id;
			$project->start_date = $info['start_date'];
			$project->end_date = $info['end_date'];
			$project->semester_id = $info['semester_id'];
			if(isset($info['file_name'])) {
				$project->filename = $info['file_name'];
			}			

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
		$project = Project::with('students', 'projectType', 'projectAbstract', 'mentor', 'semester')->where('id','=',$id)->first();

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
				'semester' => $project->semester->type.' '.$project->semester->start_year.'-'.$project->semester->end_year,
			);
		$results['students'] = $project->students->toArray();

		return View::make('projectProfile', ['data'=>$results]);
	}
}