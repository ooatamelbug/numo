<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'title_slug',
      'body',
      'status',
      'admin_id',
    ];

    public function admins()
    {
        return $this->belongsTo(Admins::class, 'admin_id');
    }
    ////////////////////////////
    // handel PermisionsAdmins Relationships
     public function news_images()
     {
         return $this->hasMany(NewsImages::class, 'news_id');
     }
}
