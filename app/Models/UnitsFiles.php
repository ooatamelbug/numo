<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitsFiles extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'status',
      'unit_id'
    ];

    public function courses_details_unites()
    {
        return $this->belongsTo(CoursesDetailsUnites::class, 'unit_id');
    }
}
