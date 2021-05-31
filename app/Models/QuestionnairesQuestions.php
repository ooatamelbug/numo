<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairesQuestions extends Model
{
    use HasFactory;
    protected $fillable = [
      'body',
      'type',
      'status',
      'number_of_question',
      'questionnaires_q_title_id',
      'questionnaire_id'
    ];

    public function questionnaires()
    {
        return $this->belongsTo(Questionnaires::class, 'questionnaire_id');
    }
    public function questionnaires_questions_titles()
    {
        return $this->belongsTo(QuestionnairesQuestionsTitles::class, 'questionnaires_q_title_id');
    }
    ////////////////////////////
    // handel questionnaires_questions_choices Relationships
     public function questionnaires_questions_anwser_choices()
     {
         return $this->hasMany(QuestionnairesQuestionsChoices::class, 'qnaires_q_id');
     }// handel PermisionsAdmins Relationships
     public function questionnaires_questions_anwser_choices()
     {
         return $this->hasMany(QuestionnairesQuestionsAnwserChoices::class, 'qnaires_q_id');
     }
    // handel PermisionsAdmins Relationships
     public function questionnaires_questions_anwser_writes()
     {
         return $this->hasMany(QuestionnairesQuestionsAnwserWrites::class, 'qnaires_q_id');
     }
}
