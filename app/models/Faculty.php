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

	public function specializations() {
		return $this->hasMany('Specialization', 'faculty_id', 'id');
	}

	public function getFreeSlots() {
		$slots = $this->freeSlots;
		$return = array();

		foreach($slots as $slot) {
			$item['day'] = $slot->day;

			if($slot->from_time > 12) {
				$item['fromTime'] = ($slot->from_time - 12).'pm';
			} else {
				$item['fromTime'] = ($slot->from_time).'am';
			}

			if($slot->to_time > 12) {
				$item['toTime'] = ($slot->to_time - 12).'pm';
			} else {
				$item['toTime'] = ($slot->to_time).'am';
			}

			$item['from'] = $slot->from_time;
			$item['to'] = $slot->to_time;

			array_push($return, $item);
		}

		return $return;
	}

	public function getSpecializations() {
		$specs = $this->specializations;

		$data = array();

		foreach($specs as $spec) {
			$item['value'] = $spec->specialization;

			array_push($data, $item);
		}

		return $data;
	} 

	public function getSubjects() {
		$subjects = DB::table('faculties_has_subjects')
				->join('subjects', 'faculties_has_subjects.subject_id','=','subjects.id')
				->join('semesters', 'faculties_has_subjects.semester_id', '=','semesters.id')
				->select('subject_id as id','subject', 'subject_code', 'type as semester_type', 'start_year', 'end_year')
				->where('faculties_has_subjects.faculty_id','=', $this->id)
				->orderBy('start_year', 'desc')
				->take(7)
				->get();

		return $subjects;
	}

	public function removeSubject($subject_id) {
		DB::beginTransaction();

		try {
			DB::table('faculties_has_subjects')
			->where('faculty_id','=',$this->id)
			->where('subject_id','=', $subject_id)
			->delete();
			DB::commit();
		} catch (\PDOException $e) {
			DB::rollback();
			throw $e;
		}
		
	}

	public function insertSubject($subject_id, $semester_id) {
		DB::beginTransaction();

		try {
			DB::table('faculties_has_subjects')
				->insert(array('subject_id'=>$subject_id, 'semester_id'=>$semester_id, 'faculty_id'=>$this->id));

			DB::commit();
		} catch(\PDOException $e) {
			DB::rollback();
			throw $e;
		}
	}
	
}