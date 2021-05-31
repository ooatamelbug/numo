<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisions extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'status'
    ];


   // handel PermisionsAdmins Relationships
    public function permisionsAdmins()
    {
        return $this->hasMany(PermisionsAdmins::class, 'permision_id');
    }

}
