<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairesQuestionsType extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'status'
    ];

    public function questionnaires_questions_titles()
    {
        return $this->hasMany(QuestionnairesQuestionsTitles::class, 'questionnaires_q_type_id');
    }
}
