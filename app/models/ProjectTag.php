<?php

class ProjectTag extends BaseEloquent {
	protected $guarded = ['id'];

	protected $hidden = ['pivot'];

	protected $table = 'project_tags';

	public $timestamps = false;

	public function projects() {
		return $this->belongsToMany('Project', 'projects_has_project_tags', 'project_tag_id', 'project_id');
	}
}