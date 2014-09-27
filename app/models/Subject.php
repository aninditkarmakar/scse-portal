<?php

use Illuminate\Database\Eloquent\Model as Model;

class Subject extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'subjects';

	public $timestamps = false;

	public function newPivot(Model $parent, array $attributes, $table, $exists) {

		if($parent instanceof Faculty) {
			return new FacultySubjectPivot($parent, $attributes, $table, $exists);
		} 

		return parent::newPivot($parent, $attributes, $table, $exists);
	}

	public function getIdAttribute($value) {
		return (int) $value;
	}

	public function faculties() {
		return $this->belongsToMany('Faculty', 'faculties_has_subjects', 'subject_id', 'faculty_id');
	}
}