<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'status',
      'body',
      'date_open',
      'teacher_id',
      'unit_id',
      'course_id',
      'admin_id'
    ];

    public function teachers()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id');
    }
    public function courses_details_unites()
    {
        return $this->belongsTo(CoursesDetailsUnites::class, 'unit_id');
    }
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
    public function admins()
    {
        return $this->belongsTo(Admins::class, 'admin_id');
    }
    ////////////////////////////
    // handel PermisionsAdmins Relationships
     public function Exams_courses()
     {
         return $this->hasMany(ExamsCourses::class, 'exam_id');
     }// handel PermisionsAdmins Relationships
     public function Exams_questions_titles()
     {
         return $this->hasMany(ExamsQuestionsTitles::class, 'exam_id');
     }// handel PermisionsAdmins Relationships
     public function Exams_questions()
     {
         return $this->hasMany(ExamsQuestions::class, 'exam_id');
     }// handel PermisionsAdmins Relationships
     public function Exams_enters()
     {
         return $this->hasMany(ExamsEnters::class, 'exam_id');
     }// handel PermisionsAdmins Relationships
     public function Exams_questions_anwser_choices()
     {
         return $this->hasMany(ExamsQuestionsAnwserChoices::class, 'exam_id');
     }// handel PermisionsAdmins Relationships
     public function Exams_questions_anwser_writes()
     {
         return $this->hasMany(ExamsAuestionsAnwserWrites::class, 'exam_id');
     }
    // handel PermisionsAdmins Relationships
     public function Exams_finishes()
     {
         return $this->hasMany(ExamsFinishes::class, 'exam_id');
     }
     public function exam_details()
     {
         return $this->hasOne(ExamDetails::class, 'exam_id');
     }
     public function exam_questions_delays()
     {
         return $this->hasMany(ExamQuestionsDelays::class, 'exam_id');
     }
}
