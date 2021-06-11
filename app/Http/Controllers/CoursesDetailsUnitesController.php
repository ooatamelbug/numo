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
      $coursefound =Courses::find($course);
      if(!$coursefound){
        return response()->json([
          'msg' => 'not found',
          'success' => false,
          'status' => 404
        ]);
      }
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
          "title" => 'required',
          "ranged" => 'required',
          "desc" => 'required',
          'course_id' => 'max:100|required',
          "image" => 'nullable',
          "total_time" => 'required'
      ]);
      $coursefound =Courses::find($request->course_id);
      if(!$coursefound){
        return response()->json([
          'msg' => 'not found',
          'success' => false,
          'status' => 404
        ]);
      }
      $link = '';
        if($request->hasfile('image')) {
          $file = $request->file('image');
          $name =  time().$file->getClientOriginalName();
          $file->move(public_path('/uploads/course/'), $name);
          $link = "uploads/course/".$name;
        }

        $u = CoursesDetailsUnites::create([
          "title" => $request->title,
          "ranged" => $request->ranged,
          "desc" => $request->desc,
          "image" => $link,
          "course_id" => $request->course_id,
          "total_time" => $request->total_time,
        ]);
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => $u
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
      $coursefound =Courses::find($coursesDetailsUnites);
      if(!$coursefound){
        return response()->json([
          'msg' => 'not found',
          'success' => false,
          'status' => 404
        ]);
      }
      $un = CoursesDetailsUnites::where('course_id', $coursesDetailsUnites)->get();
      $f = UnitsFiles::where('unit_id', $coursesDetailsUnites)
      ->get();
      $v = UnitVideo::where('unit_id', $coursesDetailsUnites)
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

      if(!$courses){
        return response()->json([
          'msg' => 'not found',
          'success' => false,
          'status' => 404
        ]);
      }
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
      $link = '';
      if($request->hasfile('image')) {
        $file = $request->file('image');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path('/uploads/course/'), $name);
        $link = "uploads/course/".$name;

      }

      $course = CoursesDetailsUnites::where('id', $coursesDetailsUnites->id)->update(
        array_merge($request->all(), [
          "image" =>  $link ])
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
    public function destroy(Request $request, CoursesDetailsUnites $coursesDetailsUnites)
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
