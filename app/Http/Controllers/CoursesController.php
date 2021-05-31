<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\CoursesDetails;
use App\Models\CoursesDetailsUnites;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $courses = Courses::join(
        "teachers","teachers.id", "=" , "courses.teacher_id"
      )->join(
        "categories","categories.id", "=" , "courses.categories_id"
      )->join(
          "admins","admins.id", "=" , "courses.admin_id"
      )->select(
        "courses.*", "categories.title as categories",
        "teachers.first_name as teachers",
        "admins.first_name as admins"
      )
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
    public function active(Request $request, $courses)
    {
      if(!$request->user()->tokenCan('courses:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      if(!$request->user()->rolls || $request->user()->id != $courses ){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'status' => 'required|max:100'
      ]);
      $course = Courses::where('id', $courses)->update(
        [
          'status' =>$request->status,
          'admin_id' => $request->user()->id
        ]
      );

      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'update'
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!$request->user()->tokenCan('courses:create')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'title' => 'required|max:100',
        'image' => 'required|images|mimes:png,jpg',
        'price' => 'required|max:100',
        'discount' => 'max:100|nullable',
        'desc' => 'nullable',
        'categories_id' => 'required|max:100'
        'teacher_id' => 'required|max:100'
      ]);

      if($request->hasfile('image')) {
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/uploads/courses/', $name);
      }

      $courses = Courses::create(
        array_merge($request->all(),[
          'admin_id' => $request->user()->id,
          'image' => $name,
         ]),
      );
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => $courses
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function show(Courses $courses)
    {
      if(!$request->user()->tokenCan('courses:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }

        $courses = Courses::join(
          "teachers","teachers.id", "=" , "courses.teacher_id"
        )->join(
          "categories","categories.id", "=" , "courses.categories_id"
        )->join(
            "admins","admins.id", "=" , "courses.admin_id"
        )->select(
          "courses.*", "categories.title as categories",
          "teachers.first_name as teachers",
          "admins.first_name as admins"
        )->where("id", $courses->id )
        ->get();
        $couresedetails = CoursesDetails::where("course_id", $courses->id )->get();
        $courses->details = $couresedetails;
        return response()->json([
            'success' => true,
            'status' => 200 ,
            'data' => $courses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function search($courses, $search = '')
    {
      $courses = Courses::join(
        "teachers","teachers.id", "=" , "courses.teacher_id"
      )->join(
        "categories","categories.id", "=" , "courses.categories_id"
      )->join(
          "admins","admins.id", "=" , "courses.admin_id"
      )->select(
        "courses.*", "categories.title as categories",
        "teachers.first_name as teachers",
        "admins.first_name as admins"
      )->where("categories_id", $courses)
      ->where('title', 'like', '%'.$search.'%')
      ->get();
      $couresedetails = CoursesDetails::where("course_id", $courses->id )->get();
      $courses->details = $couresedetails;
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
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $courses)
    {
      if(!$request->user()->tokenCan('courses:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
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
        'image' => 'required|images|mimes:png,jpg',
        'price' => 'required|max:100',
        'discount' => 'max:100|nullable',
        'desc' => 'nullable',
        'categories_id' => 'required|max:100'
        'teacher_id' => 'required|max:100'
      ]);

      if($request->hasfile('image')) {
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/uploads/', $name);
      }

      $course = Courses::where('id', $courses->id)->update(
        array_merge($request->all(),[
          'image' =>$name,
          'admin_id' => $request->user()->id
        ]),
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
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Courses $courses)
    {
      if(!$request->user()->tokenCan('courses:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $courses->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);

    }
}
