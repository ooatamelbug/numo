<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsSider extends Model
{
    use HasFactory;
    protected $fillable = [
      'ranged',
      'status',
      'title',
      'link'
    ];

}
