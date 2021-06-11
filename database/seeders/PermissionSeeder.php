<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $per = ['permisions','admins',
                'permisions_admins',
                'teachers', 'news' ,
                'news_images' , 'students',
                'categories', 'courses' ,
           'courses_details' , 'courses_details_unites',
          'carts', 'carts_details' ,
           'permisions_teachers' ,
           'order_payments',
          'order_payment_details', 'exams' ,
           'exam_questions_types' , 'exam_details',
          'exam_questions_titles', 'exam_questions' ,
           'exam_questions_choices' , 'exam_enters',
          'exam_questions_anwser_choices',
           'exam_questions_anwser_writes' , 'exam_questions_delays' , 'exam_finials',
          'questionnaires', 'questionnaires_questions_types' , 'questionnaires_enters' , 'questionnaires_questions_anwser_choices',
          'questionnaires_questions_anwser_writes', 'questionnaires_finishes' , 'course_rates' , 'units_files',
          'unit_videos', 'settings_media' , 'settings_siders'
        ];
        $allow = ['read', 'create', 'update', 'delete'];

        for ($i=0; $i < count($per); $i++) {
          for ($z=0; $z < count($allow); $z++) {
            DB::table('permisions')->insert([
              'status' => 1,
              'title' => $per[$i].':'.$allow[$z]
            ]);
          }
        }
    }
}
