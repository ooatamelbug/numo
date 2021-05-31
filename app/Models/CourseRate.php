<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRate extends Model
{
    use HasFactory;
    protected $fillable = [
      'degree',
      'course_id',
      'student_id'
    ];
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}
