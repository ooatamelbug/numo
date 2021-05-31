<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;
    protected $fillable = [
      'total_price',
      'total_units',
      'status',
      'operation_bank_id',
      'student_id',
    ];

    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    ////////////////////////////
    // handel PermisionsAdmins Relationships
     public function courses_subscriptions()
     {
         return $this->hasMany(CoursesSubscriptions::class, 'order_payment_id');
     }// handel PermisionsAdmins Relationships
     public function order_payment_details()
     {
         return $this->hasMany(OrderPaymentDetails::class, 'order_payment_id');
     }
}
