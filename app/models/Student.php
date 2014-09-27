<?php

class Student extends BaseEloquent {
	protected $guarded = ['id'];

	protected $table = 'students';

	protected $hidden = array('created_at','updated_at');

	public function projects() {
		return $this->belongsToMany('Project', 'student_has_project', 'student_id', 'project_id');
	}

	
}