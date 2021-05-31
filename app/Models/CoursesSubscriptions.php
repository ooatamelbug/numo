<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesSubscriptions extends Model
{
    use HasFactory;
    protected $fillable = [
      'order_payment_id',
      'student_id',
      'course_id'
    ];
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function order_payments()
    {
        return $this->belongsTo(OrderPayments::class, 'order_payment_id');
    }
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
