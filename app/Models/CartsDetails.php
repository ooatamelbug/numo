<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartsDetails extends Model
{
    use HasFactory;

    protected $fillable = [
      'course_id',
      'cart_id'
    ];
    public function carts()
    {
        return $this->belongsTo(Carts::class, 'cart_id');
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

}
