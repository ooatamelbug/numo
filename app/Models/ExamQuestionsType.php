<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestionsType extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
      'status'
    ];

    public function exam_questions_titles()
    {
        return $this->hasMany(ExamTuestionsTitles::class, 'exam_questions_types');
    }
}
