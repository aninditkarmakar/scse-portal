<?php

use Illuminate\Database\Eloquent\Model as Model;


class BaseEloquent extends \Eloquent {
	protected $fillable = [];

	public function newPivot(Model $parent, array $attributes, $table, $exists) {

		// if(($parent instanceof Faculty) || ($parent instanceof Subject)) {
		// 	return new FacultySubjectPivot($parent, $attributes, $table, $exists);
		// } else {
		// 	return new 
		// }
	}
}