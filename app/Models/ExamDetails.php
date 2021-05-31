<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDetails extends Model
{
    use HasFactory;
    protected $fillable = [
      'question_number',
      'degree',
      'time',
      'question_open_number',
      'exam_id',
    ];

    public function exams()
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }
}
