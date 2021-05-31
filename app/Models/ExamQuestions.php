<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestions extends Model
{
    use HasFactory;
    protected $fillable = [
      'body',
      'type',
      'status',
      'number_of_question',
      'exam_questions_title_id',
      'exam_id'
    ];

    public function exams()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }
    public function exam_questions_titles()
    {
        return $this->belongsTo(ExamQuestionsTitles::class, 'exam_questions_title_id');
    }
    ////////////////////////////
    // handel questionnaires_questions_choices Relationships
     public function exam_questions_anwser_choices()
     {
         return $this->hasMany(ExamQuestionsChoices::class, 'exam_question_id');
     }// handel PermisionsAdmins Relationships
     public function exam_questions_anwser_choices()
     {
         return $this->hasMany(ExamQuestionsAnwserChoices::class, 'exam_question_id');
     }
    // handel PermisionsAdmins Relationships
     public function exam_questions_delays()
     {
         return $this->hasMany(ExamQuestionsDelays::class, 'exam_question_id');
     }
    // handel PermisionsAdmins Relationships
     public function exam_questions_anwser_writes()
     {
         return $this->hasMany(ExamQuestionsAnwserWrites::class, 'exam_question_id');
     }
}
