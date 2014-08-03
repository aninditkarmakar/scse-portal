<?php

class Student extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'student';

	public function projects() {
		return $this->belongsToMany('Project', 'student_has_project', 'student_id', 'project_id');
	}

	
}