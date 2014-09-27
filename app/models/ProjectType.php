<?php

class ProjectType extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'project_types';

	public $timestamps = false;

	public function projects() {
		return $this->hasMany('Project', 'type_id', 'id');
	}
}