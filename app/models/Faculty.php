<?php

use Illuminate\Database\Eloquent\Model as Model;

class Faculty extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'faculties';

	protected $hidden = array('created_at', 'updated_at');

	public function newPivot(Model $parent, array $attributes, $table, $exists) {

		if($parent instanceof Subject) {
			return new FacultySubjectPivot($parent, $attributes, $table, $exists);
		} 

		return parent::newPivot($parent, $attributes, $table, $exists);
		// if(($parent instanceof Faculty) || ($parent instanceof Subject)) {
		// 	return new FacultySubjectPivot($parent, $attributes, $table, $exists);
		// } else {
		// 	return new 
		// }
	}

	public static function boot() {
		parent::boot();

		static::deleting(function($faculty) {

			$faculty->user()->delete();
			$faculty->subjects()->detach();
			$faculty->freeSlots()->delete();

			return true;
		});
	}

	public function getIdAttribute($value) {
		return (int) $value;
	}

	public function getUserIdAttribute($value) {
		return (int) $value;
	}

	public function getFacultyCodeAttribute($value) {
		return (int) $value;
	}

	public function freeSlots() {
		return $this->hasMany('FacultySlot', 'faculty_id', 'id');
	}

	public function user() {
		return $this->belongsTo('User', 'user_id', 'id');
	}

	public function subjects() {
		return $this->belongsToMany('Subject', 'faculties_has_subjects', 'faculty_id', 'subject_id')->withPivot('semester_id');
	}

	public function projects() {
		return $this->hasMany('Project', 'faculty_id', 'id');
	}

	
}