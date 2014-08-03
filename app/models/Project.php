<?php

class Project extends \Eloquent {
	protected $guarded = ['id'];

	public function abstract() {
		return $this->hasOne('ProjectAbstract', 'project_id', 'id');
	}

	public function type() {
		return $this->belongsTo('ProjectType', 'type_id');
	}

	public function mentor() {
		return $this->belongsTo('User', 'faculty_id');
	}

	public function students() {
		return $this->belongsToMany('Student', 'student_has_project', 'project_id', 'student_id');
	}
}