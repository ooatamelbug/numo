<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestionsAnwserChoices extends Model
{
    use HasFactory;
    protected $fillable = [
      'anwser_number',
      'exam_enter_id',
      'exam_questions_choice_id',
      'exam_question_id',
      'student_id',
      'exam_id'
    ];
    public function exam_questions_choices()
    {
        return $this->belongsTo(ExamQuestionsChoices::class, 'qnaires_q_ch_id');
    }
    public function exam_enters()
    {
        return $this->belongsTo(ExamEnters::class, 'qnaires_e_id');
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
