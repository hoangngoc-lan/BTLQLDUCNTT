<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productstores extends Model
{
    use HasFactory;
    protected $table='productstores';

    protected $fillable = [
		'bookstore_name',	
		'information'
	];

	public function products() {
		return $this->hasMany(
			Products::class , 
			'bookstore_id' , 'id'
		);
	}
}
