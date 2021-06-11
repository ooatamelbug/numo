<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingOnlineCourses extends Model
{
    use HasFactory;
    protected $fillable = [
      'password',
      'join_url',
      'title',
      'start_url',
      'start_at',
      'status',
      'course_id',
      'unit_id'
    ];

    public function courses_details_unites()
    {
        return $this->belongsTo(CoursesDetailsUnites::class, 'unit_id');
    }
}
