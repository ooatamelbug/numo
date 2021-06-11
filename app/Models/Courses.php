<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'title_slug',
      'desc',
      'image',
      'price',
      'discount',
      'categories_id',
      'teacher_id',
      'rate',
      'status',
      'admin_id'
    ];
    ////////////////////////////
    public function teachers()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id');
    }

    public function admins()
    {
        return $this->belongsTo(Admins::class, 'admin_id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }
    ////////////////////////////

    // handel course_rates Relationships
    public function course_rates()
    {
      return $this->hasMany(CourseRates::class, 'course_id');
    }

   // handel Courses Relationships
   public function courses()
   {
      return $this->hasMany(Courses::class, 'admin_id');
    }

   // handel Courses Relationships
   public function order_payment_details()
   {
      return $this->hasMany(OrderPaymentDetails::class, 'course_id');
    }

   // handel carts_details Relationships
   public function carts_details()
   {
      return $this->hasMany(CartsDetails::class, 'course_id');
    }

   // handel Courses Relationships
   public function courses_subscriptions()
   {
      return $this->hasMany(CoursesSubscriptions::class, 'course_id');
    }

   // handel Courses Relationships
   public function coursesDetails()
   {
      return $this->hasMany(CoursesDetails::class, 'course_id');
    }

   // handel Courses Relationships
   public function courses_details_unites()
   {
      return $this->hasMany(CoursesDetailsUnites::class, 'course_id');
    }

   // handel Courses Relationships
   public function exams()
   {
      return $this->hasMany(Exams::class, 'course_id');
    }
    public function meeting_online_course()
    {
        return $this->hasMany(MeetingOnlineCourses::class, 'course_id');
    }
}
