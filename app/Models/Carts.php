<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = [
      'total_price',
      'total_units',
      'student_id',
      'status'
    ];

    ////////////////////////////
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    // handel CartsDetails Relationships
    public function carts_details()
    {
      return $this->hasMany(CartsDetails::class, 'cart_id');
    }

    // handel CartsDetails Relationships
    public function order_payment_details()
    {
      return $this->hasMany(OrderPaymentDetails::class, 'cart_id');
    }

}
