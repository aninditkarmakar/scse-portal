<?php

class ProjectAbstract extends BaseEloquent {
	protected $guarded=['id'];

	protected $table = 'project_abstracts';

	public $timestamps = false;

	public function project() {
		return $this->belongsTo('Project', 'project_id');
	}
}