<?php

use Illuminate\Database\Eloquent\Relations\Pivot as Pivot;

class FacultySubjectPivot extends Pivot {
	protected $guarded = ['id'];

	public function getSemesterIdAttribute($value) {
		return (int) $value;
	}

	public function getFacultyIdAttribute($value) {
		return (int) $value;
	}

	public function getSubjectIdAttribute($value) {
		return (int) $value;
	}

	public function semester() {
		return $this->belongsTo('Semester', 'semester_id', 'id');
	}

	public function faculty() {
		return $this->belongsTo('Faculty', 'faculty_id', 'id');
	}

	public function subject() {
		return $this->belongsTo('Subject', 'subject_id', 'id');
	}

}