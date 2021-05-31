<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Teachers;
use Illuminate\Http\Request;
use App\Models\PermisionsTeachers;
use Auth;
use App\Models\Courses;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(!$request->user()->tokenCan('teachers:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $teachers = Teachers::all();
        return [
          'success' => true,
          'status' => 200 ,
          'data' => $teachers
      ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
      if (!Auth::guard('teachers')->attempt([
        'email' => $request->email ,
        'password' => $request->password
        ])) {
        return response()->json([
          'e' => $request->email,
          'success' => false,
          'status' => 404
        ]);
      }

      $teacher = auth()->guard('teachers')->user();
      $permisionsTeachers = PermisionsTeachers::
      join('permisions', 'permisions.id','=', 'permisions_teachers.permision_id')
     ->select('permisions.title as title')
     ->where(
         'teacher_id', $teacher->id
       )->get();
       $str = [];
       for ($i=0; $i < count($permisionsTeachers); $i++) {
         // code...
         $str[$i] = $permisionsTeachers[$i]->title;
       }
       if( count($str) == 0 ) { $str = ["*"]; }
      $token = $teacher->createToken($request->email, $str)->plainTextToken;
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => $token,
        'D' => $teacher,
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
      if(!$request->user()->tokenCan('teachers:create')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'first_name' => 'required|max:100',
        'password' => 'required|max:100',
        'last_name' => 'required|max:100',
        'email' => 'required|unique:teachers|max:100',
        'phone' => 'max:100|nullable',
        'image' => 'max:100|nullable'
      ]);
      $request->password = Hash::make($request->password);

      $teacher = Teachers::create(
        array_merge($request->all(),['password' =>$request->password, "actived_by_id" => $request->user()->id ]),
      );
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => $teacher
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Teachers $teachers)
    {
      if(!$request->user()->tokenCan('teachers:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }

      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => $teachers
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function edit(Teachers $teachers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teachers $teachers)
    {
      if(!$request->user()->tokenCan('teachers:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      if(!$request->user()->rolls || $request->user()->id != $teachers->id ){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'first_name' => 'required|max:100',
        'password' => 'required|max:100',
        'last_name' => 'required|max:100',
        'email' => 'required|unique:admins,email,'.$teachers->id.'|max:100',
        'phone' => 'max:100|nullable',
        'image' => 'max:100|nullable'
      ]);
      $request->password = Hash::make($request->password);
      $teacher = Teachers::where('id', $teachers->id)->update(
        array_merge($request->all(),['password' =>$request->password ]),
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
     * @param  \App\Models\Teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Teachers $teachers)
    {
      if(!$request->user()->tokenCan('teachers:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $teachers->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);
    }
}
