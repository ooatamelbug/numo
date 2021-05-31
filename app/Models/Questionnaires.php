<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaires extends Model
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

    public function admins()
    {
        return $this->belongsTo(Admins::class, 'admin_id');
    }
    ////////////////////////////
    // handel PermisionsAdmins Relationships
     public function questionnaires_courses()
     {
         return $this->hasMany(QuestionnairesCourses::class, 'questionnaire_id');
     }// handel PermisionsAdmins Relationships
     public function questionnaires_questions_titles()
     {
         return $this->hasMany(QuestionnairesQuestionsTitles::class, 'questionnaire_id');
     }// handel PermisionsAdmins Relationships
     public function questionnaires_questions()
     {
         return $this->hasMany(QuestionnairesQuestions::class, 'questionnaire_id');
     }// handel PermisionsAdmins Relationships
     public function questionnaires_enters()
     {
         return $this->hasMany(QuestionnairesEnters::class, 'questionnaire_id');
     }// handel PermisionsAdmins Relationships
     public function questionnaires_questions_anwser_choices()
     {
         return $this->hasMany(QuestionnairesQuestionsAnwserChoices::class, 'questionnaire_id');
     }// handel PermisionsAdmins Relationships
     public function questionnaires_questions_anwser_writes()
     {
         return $this->hasMany(QuestionnairesAuestionsAnwserWrites::class, 'questionnaire_id');
     }
    // handel PermisionsAdmins Relationships
     public function questionnaires_finishes()
     {
         return $this->hasMany(QuestionnairesFinishes::class, 'questionnaire_id');
     }
}
