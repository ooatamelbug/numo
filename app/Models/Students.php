<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Students extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'first_name',
      'password',
      'last_name',
      'email',
      'phone',
      'google_id',
      'apple_id',
      'image',
      'imagecertificated',
      'imagenationalid',
      'status',
      'actived_by_id',
      'face_id'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     protected $hidden = [
         'password',
         'remember_token',
     ];
     /**
      * The attributes that should be cast to native types.
      *
      * @var array
      */
     protected $casts = [
         'email_verified_at' => 'datetime',
     ];

    public function admins()
    {
        return $this->belongsTo(Admins::class, 'actived_by_id');
    }
    /////////////////////////
    // handel PermisionsAdmins Relationships
     public function courses_subscriptions()
     {
         return $this->hasMany(CoursesSubscriptions::class, 'student_id');
     }
     // handel PermisionsAdmins Relationships
     public function carts()
     {
         return $this->hasMany(Carts::class, 'student_id');
     }
     // handel order_payments Relationships
     public function order_payments()
     {
         return $this->hasMany(OrderPayments::class, 'student_id');
     }
     // handel PermisionsAdmins Relationships
     public function exam_enters()
     {
         return $this->hasMany(ExamEnters::class, 'student_id');
     }
     // handel PermisionsAdmins Relationships
     public function exam_questions_anwser_writes()
     {
         return $this->hasMany(ExamQuestionsAnwserWrites::class, 'student_id');
     }
     // handel PermisionsAdmins Relationships
     public function exam_questions_anwser_choices()
     {
         return $this->hasMany(ExamQuestionsAnwserChoices::class, 'student_id');
     }
     // handel PermisionsAdmins Relationships
     public function exam_questions_delays()
     {
         return $this->hasMany(ExamQuestionsDelays::class, 'student_id');
     }
     // handel exam_finials Relationships
     public function exam_finials()
     {
         return $this->hasMany(ExamFinials::class, 'student_id');
     }// handel questionnaires_enters Relationships
     public function questionnaires_enters()
     {
         return $this->hasMany(QuestionnairesEnters::class, 'student_id');
     }
     // handel PermisionsAdmins Relationships
     public function questionnaires_questions_anwser_choices()
     {
         return $this->hasMany(QuestionnairesQuestionsAnwserChoices::class, 'actived_by_id');
     }
     // handel PermisionsAdmins Relationships
     public function questionnairesQuestionsAnwserWrites()
     {
         return $this->hasMany(QuestionnairesQuestionsAnwserWrites::class, 'actived_by_id');
     }
     
     // handel PermisionsAdmins Relationships
     public function course_rates()
     {
         return $this->hasMany(CourseRates::class, 'actived_by_id');
     }


}
