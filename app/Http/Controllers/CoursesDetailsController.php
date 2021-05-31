<?php

namespace App\Http\Controllers;
use App\Models\Courses;

use App\Models\CoursesDetails;
use Illuminate\Http\Request;
use App\Models\CoursesDetailsUnites;
use App\Models\UnitsFiles;
use App\Models\UnitVideo;

class CoursesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course)
    {
      $courses = CoursesDetails::join(

          "courses","courses.id", "=" , "courses_details.course_id"
      )->select(
        "courses_details.*",
        "courses.title as course"
      )->where('course_id', $course)
      ->get();
      $un = CoursesDetailsUnites::->where('course_id', $coursesDetails)->get();
      $courses->details_unites = $un;
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => $courses
      ]);
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
      if(!$request->user()->tokenCan('courses_details:create')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'units' => 'required|max:100',
        'total_time' => 'required|max:100',
        'desc' => 'max:100|nullable',
        'course_id' => 'max:100|required',
        "unites" => [
          "title" => 'required',
          "ranged" => 'required',
          "desc" => 'required',
          "image" => 'required',
          "total_time" => 'required'
        ]
      ]);
      $course = CoursesDetails::create(
        [
          'units' =>$request->units,
          'total_time' =>$request->total_time,
          'desc' =>$request->desc,
          'course_id' =>$request->course_id
        ]
      );

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
     * @param  \App\Models\CoursesDetails  $coursesDetails
     * @return \Illuminate\Http\Response
     */
    public function show($coursesDetails)
    {
      $courses = CoursesDetails::join(

          "courses","courses.id", "=" , "courses_details.course_id"
      )->select(
        "courses_details.*",
        "courses.title as course"
      )->where('id', $coursesDetails)
      ->get();
      // $f = UnitsFiles::->where('unit_id', $coursesDetails)
      // ->get();
      // $v = UnitVideo::->where('unit_id', $coursesDetails)
      // ->get();
      $un = CoursesDetailsUnites::->where('course_id', $coursesDetails)->get();
      $courses->details_unites = $un;
      // $courses->file = $f;
      // $courses->video = $v;
      return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => $courses
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CoursesDetails  $coursesDetails
     * @return \Illuminate\Http\Response
     */
    public function showout($coursesDetails)
    {
      $courses = CoursesDetails::join(

          "courses","courses.id", "=" , "courses_details.course_id"
      )->select(
        "courses_details.*",
        "courses.title as course"
      )->where('id', $coursesDetails)
      ->get();
      $un = CoursesDetailsUnites::->where('course_id', $coursesDetails)->get();
      $courses->details_unites = $un;
      return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => $courses
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoursesDetails  $coursesDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoursesDetails $coursesDetails)
    {
      if(!$request->user()->tokenCan('courses_details:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $courses = Courses::find($coursesDetails->course_id);
      if(!$request->user()->rolls || $request->user()->id != $courses->teacher_id ){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'units' => 'required|max:100',
        'total_time' => 'required|max:100',
        'course_id' => 'required|max:100',
        'desc' => 'max:100|nullable',
      ]);

      $course = CoursesDetails::where('id', $coursesDetails->id)->update(
        array_merge($request->all())
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
     * @param  \App\Models\CoursesDetails  $coursesDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoursesDetails $coursesDetails)
    {
      if(!$request->user()->tokenCan('courses_details:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $coursesDetails->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);

    }
}
