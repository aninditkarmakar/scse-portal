<?php

class FacultySlot extends \Eloquent {
	protected $guarded = ['id'];

	public $timestamps = false;

	public function faculty() {
		return $this->belongsTo('Faculty', 'faculty_id', 'id');
	}
}