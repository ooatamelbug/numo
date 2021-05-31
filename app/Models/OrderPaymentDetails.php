<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPaymentDetails extends Model
{
    use HasFactory;
    protected $fillable = [
      'course_id',
      'cart_id',
    ];
    public function order_payments()
    {
        return $this->hasMany(OrderPayments::class, 'order_payment_id');
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

}
