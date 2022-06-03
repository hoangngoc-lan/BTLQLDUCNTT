<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
	protected $table='tags';
	
	protected $fillable = [
		'id' ,
		'tag_name'
	];

	public function product_tags() {
		return $this->hasMany(
			Book_tags::class , 
			'tag_id' , 'id'
		);
	}
}
