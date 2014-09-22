<?php

class ProjectAbstract extends \Eloquent {
	protected $guarded=['id'];

	protected $table = 'project_abstract';

	public function project() {
		$this->belongsTo('Project', 'project_id');
	}
}