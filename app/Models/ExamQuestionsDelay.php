<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestionsDelay extends Model
{
    use HasFactory;
    protected $fillable = [
      'status',
      'exam_question_id',
      'student_id',
      'exam_id',
    ];
    public function exams()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function exam_questions()
    {
        return $this->belongsTo(ExamQuestions::class, 'exam_question_id');
    }
}
