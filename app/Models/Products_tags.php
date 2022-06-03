<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_tags extends Model
{
    use HasFactory;
    protected $table='products_tags';

    protected $fillable = [
		'book_id'	,
		'tag_id'
	];

	public function product() {
		return $this->belongsTo(
			Books::class , 
			'book_id' , 'id'
		);
	}
	public function tags() {
		return $this->belongsTo(
			Tags::class , 
			'tag_id' , 'id'
		);
	}
}
