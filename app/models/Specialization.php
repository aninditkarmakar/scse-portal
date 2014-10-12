<?php

class Specialization extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'faculty_specializations';

	public $timestamps = false;

	public function faculty() {
		return $this->belongsTo('Faculty', 'faculty_id','id');
	}
}