<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admins extends Authenticatable
{
    use Notifiable;
	protected $table='admin';
	
	protected $fillable = [
		'username' ,
		'password' ,
		'name' ,
		'phonenumber' ,
		'email' ,
		'level'
	];

	protected $hidden = [
		'password'
	];
}
