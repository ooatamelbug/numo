<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairesQuestionsChoices extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'anwser',
      'status',
      'questionnaires_q_id'
    ];
    public function questionnaires_questions()
    {
        return $this->belongsTo(QuestionnairesQuestions::class, 'questionnaires_q_id');
    }
    ////////////////////

    // handel QuestionnairesQuestionsAnwserChoices Relationships
     public function questionnaires_questions_anwser_choices()
     {
         return $this->hasMany(QuestionnairesQuestionsAnwserChoices::class, 'qnaires_q_ch_id');
     }
}
