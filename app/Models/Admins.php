<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
class Admins extends Authenticatable
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
      'status',
      'image',
      'rolls'
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

     public function setPasswordAttribute($password)
     {
        if($password == ''){
          return;
        }
        $this->attributes['password'] = Hash::make($password);
     }

   ////////////////////////////
   // handel PermisionsAdmins Relationships
    public function permisionsAdminsactived()
    {
        return $this->hasMany(PermisionsAdmins::class, 'actived_by_id');
    }
   // handel PermisionsAdmins Relationships
    public function permisionsAdmins()
    {
        return $this->hasMany(PermisionsAdmins::class, 'admin_id');
    }

   // handel categories Relationships
    public function categories()
    {
        return $this->hasMany(Categories::class, 'admin_id');
    }

    // handel teachers Relationships
    public function teachers()
    {
      return $this->hasMany(Teachers::class, 'actived_by_id');
    }

    // handel news Relationships
    public function news()
    {
      return $this->hasMany(News::class, 'admin_id');
    }

    // handel students Relationships
    public function students()
    {
      return $this->hasMany(Students::class, 'actived_by_id');
    }

    // handel permisionsteachers Relationships
    public function permisionsteachers()
    {
      return $this->hasMany(PermisionsTeachers::class, 'actived_by_id');
    }

    // handel exams Relationships
    public function exams()
    {
      return $this->hasMany(Exams::class, 'admin_id');
    }
    // handel questionnaires Relationships
    public function questionnaires()
    {
      return $this->hasMany(Questionnaires::class, 'admin_id');
    }
   // handel Courses Relationships
   public function courses()
   {
      return $this->hasMany(Courses::class, 'admin_id');
    }


}
