<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Teachers extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'first_name',
      'image',
      'password',
      'last_name',
      'email',
      'actived_by_id',
      'status',
      'phone'
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
    /////////////////////////////
    public function courses()
    {
        return $this->hasMany(Courses::class, 'teacher_id');
    }
    public function permisions_teachers()
    {
        return $this->hasMany(PermisionsTeachers::class, 'teacher_id');
    }
    public function exams()
    {
        return $this->hasMany(Exams::class, 'teacher_id');
    }

}
