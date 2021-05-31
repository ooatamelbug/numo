<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestionsTitle extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'status',
      'question_number',
      'exam_questions_type_id',
      'exam_id'
    ];

    public function exam_questions_types()
    {
        return $this->belongsTo(ExamQuestionsTypes::class, 'exam_questions_type_id');
    }

    public function exams()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }
    //////////////////
    // handel PermisionsAdmins Relationships
     public function exam_questions()
     {
         return $this->hasMany(ExamQuestions::class, 'exam_questions_title_id');
     }
}
