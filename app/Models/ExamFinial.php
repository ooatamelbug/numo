<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamFinial extends Model
{
    use HasFactory;
    protected $fillable = [
      'status',
      'exam_enter_id',
      'degree',
      'student_id',
      'exam_id'
    ];

    public function exam_enters()
    {
        return $this->belongsTo(ExamsEnters::class, 'exam_enter_id');
    }
    public function exams()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}
