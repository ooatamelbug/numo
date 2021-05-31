<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairesQuestionsAnwserWrite extends Model
{
    use HasFactory;
    protected $fillable = [
      'anwser_number',
      'anwser',
      'qnaires_e_id',
      'qnaires_q_id',
      'student_id',
      'questionnaire_id'
    ];

    public function questionnaires_enters()
    {
        return $this->belongsTo(QuestionnairesEnters::class, 'qnaires_e_id');
    }
    public function questionnaires_questions()
    {
        return $this->belongsTo(QuestionnairesQuestions::class, 'qnaires_q_id');
    }
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function questionnaires()
    {
        return $this->belongsTo(Questionnaires::class, 'questionnaire_id');
    }
}
