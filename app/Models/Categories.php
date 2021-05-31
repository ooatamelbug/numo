<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'title_slug',
      'desc',
      'status',
      'admin_id'
    ];

    public function admins()
    {
        return $this->belongsTo(Admins::class, 'admin_id');
    }
    // handel Courses Relationships
    public function Courses()
    {
       return $this->hasMany(Courses::class, 'categories_id');
     }
}
