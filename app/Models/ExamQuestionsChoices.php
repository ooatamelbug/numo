<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestionsChoices extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'anwser',
      'status',
      'exam_question_id'
    ];
    public function exam_questions()
    {
        return $this->belongsTo(ExamQuestions::class, 'exam_question_id');
    }
    ////////////////////

    // handel QuestionnairesQuestionsAnwserChoices Relationships
     public function exam_questions_anwser_choices()
     {
         return $this->hasMany(ExamQuestionsAnwserChoices::class, 'exam_questions_choice_id');
     }
}
