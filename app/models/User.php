<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token', 'created_at', 'updated_at');

	public static function boot() {
		parent::boot();

		static::deleting(function($user) {
			$user->roles()->detach();
			$user->faculty()->delete();
			return true;
		});
	}

	public function roles() {
		return $this->belongsToMany('Role', 'users_has_roles', 'user_id', 'role_id');
	}

	public function faculty() {
		return $this->hasOne('Faculty', 'user_id', 'id');
	}

	

}
