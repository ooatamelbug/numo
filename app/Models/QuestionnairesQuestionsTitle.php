<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairesQuestionsTitle extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'status',
      'question_number',
      'questionnaires_q_type_id',
      'questionnaire_id'
    ];

    public function questionnaires_questions_types()
    {
        return $this->belongsTo(QuestionnairesQuestionsTypes::class, 'questionnaires_q_type_id');
    }

    public function questionnaires()
    {
        return $this->belongsTo(Questionnaires::class, 'questionnaire_id');
    }
    //////////////////
    // handel PermisionsAdmins Relationships
     public function questionnaires_questions()
     {
         return $this->hasMany(QuestionnairesQuestions::class, 'questionnaires_q_title_id');
     }

}
