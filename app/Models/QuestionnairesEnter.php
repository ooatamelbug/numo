<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairesEnter extends Model
{
    use HasFactory;
    protected $fillable = [
      'take_time',
      'number_logs',
      'date_last_open',
      'type_enter',
      'student_id',
      'questionnaire_id'
    ];
    public function questionnaires()
    {
        return $this->belongsTo(Questionnaires::class, 'questionnaire_id');
    }
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    ////////////////////////////
    // handel PermisionsAdmins Relationships
     public function questionnaires_questions_anwser_choices()
     {
         return $this->hasMany(QuestionnairesQuestionsAnwserChoices::class, 'qnaires_e_id');
     }
     // handel PermisionsAdmins Relationships
     public function questionnaires_questions_anwser_writes()
     {
         return $this->hasMany(QuestionnairesQuestionsAnwserWrites::class, 'qnaires_e_id');
     }
     // handel PermisionsAdmins Relationships
     public function questionnaires_finishes()
     {
         return $this->hasMany(QuestionnairesFinishes::class, 'questionnaires_enter_id');
     }

}
