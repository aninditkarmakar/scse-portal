<?php

class ProjectType extends BaseEloquent {
	protected $guarded = ['id'];

	protected $table = 'project_types';

	public $timestamps = false;

	public function projects() {
		return $this->hasMany('Project', 'type_id', 'id');
	}
}