<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;
    protected $table='order_details';

    protected $fillable = [
		'order_id',	
		'book_id',	
		'quantity',	
		'price'
	];

	public function orders() {
		return $this->belongsTo(
			Orders::class , 
			'order_id' , 'id'
		);
		return $this->hasMany(
			Products::class , 
			'order_id' , 'id'
		);
	}
	public function books() {
		return $this->belongsTo(
			Products::class , 
			'book_id' , 'id'
		);
	}
}
