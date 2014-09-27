<?php

class Subject extends BaseEloquent {
	protected $guarded = ['id'];

	protected $table = 'subjects';

	public $timestamps = false;

	public function getIdAttribute($value) {
		return (int) $value;
	}

	public function faculties() {
		return $this->belongsToMany('Faculty', 'faculties_has_subjects', 'subject_id', 'faculty_id');
	}
}