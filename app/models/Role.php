<?php

class Role extends \Eloquent {
	protected $guarded = ['id'];

	protected $table = 'roles';

	protected $hidden = ['pivot', 'id'];

	public $timestamps = false;

	public function users() {
		return $this->belongsToMany('User', 'users_has_roles', 'role_id', 'user_id');
	}
}