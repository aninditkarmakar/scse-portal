<?php

class Semester extends \Eloquent {
	protected $guarded = ['id'];

	public $timestamps = false;

	public function getIdAttribute($value) {
		return (int) $value;
	}

	public function getStartYearAttribute($value) {
		return (int) $value;
	}

	public function getEndYearAttribute($value) {
		return (int) $value;
	}

	public function projects() {
		return $this->hasMany('Project', 'semester_id', 'id');
	}

}