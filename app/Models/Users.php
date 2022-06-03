<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable;
    protected $table='users';

    protected $fillable = [
		'username',
		'password',	
		'name',	
		'address',	
		'phone',	
		'email'
	];

	protected $hidden = [
		'password',
		'address'
	];

	public function posts() {
		return $this->hasMany(
			Orders::class , 
			'user_id' , 'id'
		);
	}
	public function Comments() {
		return $this->hasMany(
			Comments::class , 
			'user_id' , 'id'
		);
	}
}
