<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesDetailsUnites extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'image',
      'desc',
      'total_time',
      'ranged',
      'course_id'
    ];

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
    // handel exams Relationships
     public function exams()
     {
         return $this->hasMany(Exams::class, 'unit_id');
     }
     // handel units_files Relationships
      public function units_files()
      {
          return $this->hasMany(UnitsFiles::class, 'unit_id');
      }
      // handel unit_videos Relationships
       public function unit_videos()
       {
           return $this->hasMany(UnitsVideos::class, 'unit_id');
       }
       public function meeting_online_courses()
       {
           return $this->hasMany(MeetingOnlineCourses::class, 'unit_id');
       }
    //
}
