<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisionsTeachers extends Model
{
    use HasFactory;
    protected $fillable = [
      'role',
      'permision_id',
      'teacher_id',
      'actived_by_id',
    ];

    public function admins()
    {
        return $this->belongsTo(Admins::class, 'actived_by_id');
    }
    public function teachers()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id');
    }
    public function permisions()
    {
        return $this->belongsTo(Permisions::class, 'permision_id');
    }
}
