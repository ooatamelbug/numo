<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\CoursesDetails;
use App\Models\CoursesDetailsUnites;
use App\Models\Categories;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ofset)
    {
      $limt = 10;
      $offset = ($ofset - 1) * $limt;
      $courses = Courses::join(
        "teachers","teachers.id", "=" , "courses.teacher_id"
      )->join(
        "categories","categories.id", "=" , "courses.categories_id"
      )->join(
          "admins","admins.id", "=" , "courses.admin_id"
      )->select(
        "courses.*", "categories.title as categories",
        "teachers.first_name as teachers",
        "teachers.image as teacher_image",
        "admins.first_name as admins"
      )->offset($offset)
        ->limit($limt)
      ->get();
      $coursesall = $courses->count();
        return [
          'success' => true,
          'status' => 200 ,
          'data' => $courses,
          'dataall' => $coursesall
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
      $coursesd = Courses::find($courses);
      if(!$request->user()->rolls || $request->user()->id != $coursesd->teacher_id ){
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
        'image' => 'required|mimes:png,jpg',
        'price' => 'required|max:100',
        'discount' => 'max:100|nullable',
        'desc' => 'nullable',
        'categories_id' => 'required|max:100',
        'teacher_id' => 'required|max:100'
      ]);

      if($request->hasfile('image')) {
        $file = $request->file('image');
        $name =  time().$file->getClientOriginalName();
        $file->move(public_path('/uploads/course/'), $name);
        $link = "uploads/course/".$name;
      }

      $courses = Courses::create(
        array_merge($request->all(),[
          'admin_id' => $request->user()->id,
          'image' => $link,
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


        $courses = Courses::join(
          "teachers","teachers.id", "=" , "courses.teacher_id"
        )->join(
          "categories","categories.id", "=" , "courses.categories_id"
        )->join(
            "admins","admins.id", "=" , "courses.admin_id"
        )->select(
          "courses.*",
          "categories.title as category",
          "teachers.first_name as teacher",
          "admins.first_name as admin"
        )->where("courses.id","=", $courses->id)
        ->get()->first();
        $couresedetails = CoursesDetails::where("course_id", $courses->id )->get()->first();
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
    public function search( Request $request)
    {
      $search = !$request->query('search') ? '' : $request->query('search');
      $categories =  $request->query('categories');
      $c =Categories::find($categories);
      if(!$c){
        return response()->json([
          'msg' => 'not found',
          'success' => false,
          'status' => 404
        ]);
      }
      $courses = Courses::join(
        "teachers","teachers.id", "=" , "courses.teacher_id"
      )->leftjoin(
        "categories","categories.id", "=" , "courses.categories_id"
      )->leftjoin(
          "admins","admins.id", "=" , "courses.admin_id"
      )->select(
        "courses.*",
        "teachers.first_name as teacher",
        "categories.title as category",
        "admins.first_name as admin"
      )
      ->where("courses.categories_id",'=', $categories)
      ->where('courses.title', 'like', '%'.$search.'%')
      ->get();
      for ($i=0; $i < count($courses) ; $i++) {
        // code...
        $couresedetails = CoursesDetails::where("course_id", $courses[$i]->id )->get();
        $courses->details = $couresedetails;
      }
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
        'title_slug' => 'required|max:200|unique:courses,title_slug,'.$courses->id,
        'image' => 'required|image|mimes:png,jpg',
        'price' => 'required|max:100',
        'discount' => 'max:100|nullable',
        'desc' => 'nullable',
        'categories_id' => 'required|max:100',
        'teacher_id' => 'required|max:100'
      ]);

      if($request->hasfile('image')) {
        $file = $request->file('image');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path('/uploads/course/'), $name);
        $link = "uploads/course/".$name;
      }

      $course = Courses::where('id', $courses->id)->update(
        array_merge($request->all(),[
          'image' => $link,
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
