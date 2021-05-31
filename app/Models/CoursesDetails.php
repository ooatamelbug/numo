<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesDetails extends Model
{
    use HasFactory;
    protected $fillable = [
      'units',
      'total_time',
      'desc',
      'course_id'
    ];
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

}
