<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairesFinish extends Model
{
    use HasFactory;
    protected $fillable = [
      'status',
      'questionnaires_enter_id',
      'student_id',
      'questionnaire_id'
    ];

    public function questionnaires_enters()
    {
        return $this->belongsTo(QuestionnairesEnters::class, 'questionnaires_enter_id');
    }
    public function questionnaires()
    {
        return $this->belongsTo(Questionnaires::class, 'questionnaire_id');
    }
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
}
