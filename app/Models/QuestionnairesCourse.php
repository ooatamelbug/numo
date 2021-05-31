<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairesCourse extends Model
{
    use HasFactory;
    protected $fillable = [
      'course_id',
      'questionnaire_id',
    ];
    public function questionnaires()
    {
        return $this->belongsTo(Questionnaires::class, 'questionnaire_id');
    }
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
