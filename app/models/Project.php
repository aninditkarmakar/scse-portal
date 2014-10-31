<?php

class Project extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'projects';

	protected $hidden = ['type_id', 'faculty_id'];

	public $timestamps = false;

	public function projectAbstract() {
		return $this->hasOne('ProjectAbstract', 'project_id', 'id');
	}

	public function projectType() {
		return $this->belongsTo('ProjectType', 'type_id');
	}

	public function mentor() {
		return $this->belongsTo('Faculty', 'faculty_id');
	}

	public function students() {
		return $this->belongsToMany('Student', 'students_has_projects', 'project_id', 'student_id');
	}

	public function tags() {
		return $this->belongsToMany('ProjectTag', 'projects_has_project_tags', 'project_id', 'project_tag_id');
	}
}