<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamEnter extends Model
{
    use HasFactory;
    protected $fillable = [
      'take_time',
      'number_logs',
      'date_last_open',
      'type_enter',
      'student_id',
      'exam_id'
    ];
    public function exams()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }
    public function students()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    ////////////////////////////
    // handel PermisionsAdmins Relationships
     public function Exams_questions_anwser_choices()
     {
         return $this->hasMany(ExamsQuestionsAnwserChoices::class, 'exam_enter_id');
     }
     // handel PermisionsAdmins Relationships
     public function Exams_questions_anwser_writes()
     {
         return $this->hasMany(ExamsQuestionsAnwserWrites::class, 'exam_enter_id');
     }
     // handel PermisionsAdmins Relationships
     public function Exams_finishes()
     {
         return $this->hasMany(ExamsFinishes::class, 'exam_enter_id');
     }
}
