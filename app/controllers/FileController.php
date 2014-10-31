<?php

class FileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /file
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /file/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /file
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /file/{id}
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
	 * GET /file/{id}/edit
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
	 * PUT /file/{id}
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
	 * DELETE /file/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function getProjectPDF($filename) {
		$filePath = base_path().'/user_files/faculty/projects/'.$filename;
		return Response::download($filePath, $filename, array('Content-Type: application/pdf'));
	} 

	public function getPublicationsList($filename) {
		$filePath = base_path().'/user_files/faculty/publications/'.$filename;
		return Response::download($filePath, $filename, array('Content-Type: application/pdf'));
	}

	public function professorPublicationUpload() {
		$maxFileSize = 5; //MB
		$basePath = base_path();
		
		if(!Input::hasFile('publications')) {
			return Redirect::route('professor-profile')->withErrors(['message' => 'Please upload a file!']);
		}

		$file = Input::file('publications');

		if($file->getSize() > $maxFileSize*1024*1024) {
			return Redirect::route('professor-profile')->withErrors(['message' => 'Max Filesize: '.$maxFileSize.'MB!']);
		}

		if($file->getClientOriginalExtension() !== 'pdf') {
			return Redirect::route('professor-profile')->withErrors(['message'=>'File should be in PDF format']);
		}

		$faculty = Auth::user()->faculty;

		$info['filename'] = $faculty->id.'_publications.pdf';

		$filePath = $basePath.'/user_files/faculty/publications/';

		try {
			$file->move($filePath, $info['filename']);
		} catch(\Exception $e) {
			return Redirect::route('professor-add-project')->withErrors(['message'=>'There was an error. Please try again']);
		}

		return Redirect::route('professor-profile');
	}
}