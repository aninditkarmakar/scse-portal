<?php

class Subject extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'subjects';

	public $timestamps = false;

	public function faculties() {
		return $this->belongsToMany('Faculty', 'faculties_has_subjects', 'subject_id', 'faculty_id');
	}
}