<?php

class ProjectAbstract extends \Eloquent {
	protected $guarded=['id'];

	public function project() {
		$this->belongsTo('Project', 'project_id');
	}
}