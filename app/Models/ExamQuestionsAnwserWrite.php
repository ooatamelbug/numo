<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestionsAnwserWrite extends Model
{
    use HasFactory;
    protected $fillable = [
      'anwser_number',
      'anwser',
      'exam_enter_id',
      'exam_question_id',
      'student_id',
      'exam_id'
    ];

    public function exam_enters()
    {
        return $this->belongsTo(ExamEnters::class, 'exam_enter_id');
    }
    public function exam_questions()
    {
        return $this->belongsTo(ExamQuestions::class, 'exam_question_id');
    }
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function exams()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }
}
