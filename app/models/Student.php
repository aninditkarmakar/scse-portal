<?php

class Student extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'students';

	protected $hidden = array('created_at','updated_at');

	public function projects() {
		return $this->belongsToMany('Project', 'students_has_projects', 'student_id', 'project_id');
	}

	
}