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


	public function searchProjects() {
		$searchTerm = Input::get('q');

		$s = '%'.$searchTerm.'%';

		$projects = DB::table('project')
			->select('id', 'title as name')
			->where('title','like',$s)
			->take(10)
			->get();

		return json_encode($projects);
	}

	public function searchFaculty() {
		$searchTerm = Input::get('q');

		$s = '%'.$searchTerm.'%';

		$faculties = DB::table('faculty')
			->select('id', DB::raw("concat(`firstname`, ' ', `lastname`) as name"))
			->where('firstname','like',$s)
			->orWhere(function($query) use ($s) {
				$query->where('lastname', 'like', $s);
			})
			//->take(20)
			->get();

		return json_encode($faculties);
	}

	public function searchAllProjects() {
		$projects = DB::table('project')
			->select('id', 'title as title')
			->orderBy('id')
			->get();

		return json_encode($projects);
	}
}
