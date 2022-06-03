<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table='products';

    protected $fillable = [
		'book_name',
		'author'	,
		'image',	
		'quantity'	,
		'description'	,
		'price'	,
		'bookstore_id'
	];

	public function productstores() {
		return $this->belongsTo(
			Bookstores::class , 
			'bookstore_id' , 'id'
		);
	}
	public function product_tags() {
		return $this->hasMany(
			Book_tags::class , 
			'book_id' , 'id'
		);
	}
	public function comments() {
		return $this->hasMany(
			Book_tags::class , 
			'book_id' , 'id'
		);
	}
}
