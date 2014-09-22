<?php

class Faculty extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'faculties';

	protected $hidden = array('created_at', 'updated_at');

	public static function boot() {
		parent::boot();

		static::deleting(function($faculty) {

			$faculty->user()->delete();
			$faculty->subjects()->detach();

			return true;
		});
	}

	public function user() {
		return $this->belongsTo('User', 'user_id', 'id');
	}

	public function subjects() {
		return $this->belongsToMany('Subject', 'faculties_has_subjects', 'faculty_id', 'subject_id');
	}

	public function projects() {
		return $this->hasMany('Project', 'faculty_id', 'id');
	}

	
}