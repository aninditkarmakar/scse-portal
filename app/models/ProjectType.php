<?php

class ProjectType extends \Eloquent {
	protected $guarded = ['id'];

	public function projects() {
		return $this->hasMany('Project', 'type_id', 'id');
	}
}