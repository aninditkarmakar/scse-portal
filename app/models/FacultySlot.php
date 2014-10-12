<?php

class FacultySlot extends \Eloquent {
	protected $guarded = ['id'];

	public $timestamps = false;

	protected $table = 'faculties_free_slots';

	public function faculty() {
		return $this->belongsTo('Faculty', 'faculty_id', 'id');
	}
}