<?php

class Semester extends BaseEloquent {
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

}