<?php

namespace App\Http\Controllers;
use App\Models\Courses;
use App\Models\UnitsFiles;
use App\Models\UnitVideo;
use App\Models\CoursesDetailsUnites;
use Illuminate\Http\Request;

class CoursesDetailsUnitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course)
    {
      $courses = CoursesDetailsUnites::join(

          "courses","courses.id", "=" , "courses_details_unites.course_id"
      )->select(
        "courses_details_unites.*",
        "courses.title as course"
      )->where('course_id', $course)
      ->get();
        return [
          'success' => true,
          'status' => 200 ,
          'data' => $courses
      ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!$request->user()->tokenCan('courses_details_unites:create')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'course_id' => 'max:100|required',
        "unites" => [
          "title" => 'required',
          "ranged" => 'required',
          "desc" => 'required',
          "image" => 'required',
          "total_time" => 'required'
        ]
      ]);

      for ($i=0; $i < count($request->unites) ; $i++) {
        // code...
        if($request->unites[$i]->hasfile('image')) {
          $file = $request->file('image');
          $name = $file->getClientOriginalName();
          $file->move(public_path().'/uploads/courses/', $name);
        }

        $u = CoursesDetailsUnites::create([
          "title" => $request->unites[$i]->title,
          "ranged" => $request->unites[$i]->ranged,
          "desc" => $request->unites[$i]->desc,
          "image" => $name,
          "course_id" => $request->course_id,
          "total_time" => $request->unites[$i]->total_time,
        ]);
      }
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => $course
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoursesDetailsUnites  $coursesDetailsUnites
     * @return \Illuminate\Http\Response
     */
    public function show($coursesDetailsUnites)
    {
      $un = CoursesDetailsUnites::->where('course_id', $coursesDetailsUnites)->get();
      $f = UnitsFiles::->where('unit_id', $coursesDetailsUnites)
      ->get();
      $v = UnitVideo::->where('unit_id', $coursesDetailsUnites)
      ->get();
      $un->file = $f;
      $un->video = $v;
      return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => $un
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CoursesDetailsUnites  $coursesDetailsUnites
     * @return \Illuminate\Http\Response
     */
    public function edit(CoursesDetailsUnites $coursesDetailsUnites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoursesDetailsUnites  $coursesDetailsUnites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoursesDetailsUnites $coursesDetailsUnites)
    {
      if(!$request->user()->tokenCan('courses_details_unites:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $courses = Courses::find($coursesDetailsUnites->course_id);
      if(!$request->user()->rolls || $request->user()->id != $courses->teacher_id ){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'title' => 'required|max:100',
        'ranged' => 'required|max:100',
        'desc' => 'nullable|max:100',
        'image'  => 'max:100|nullable',
        'total_time' => 'max:100|nullable',
        'course_id' => 'max:100|nullable',
      ]);
      if($request->unites[$i]->hasfile('image')) {
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/uploads/courses/', $name);
      }

      $course = CoursesDetailsUnites::where('id', $coursesDetailsUnites->id)->update(
        array_merge($request->all(), ["image" =>  $name ])
      );

      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'update'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoursesDetailsUnites  $coursesDetailsUnites
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoursesDetailsUnites $coursesDetailsUnites)
    {
      if(!$request->user()->tokenCan('courses_details_unites:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $coursesDetailsUnites->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);

    }
}
