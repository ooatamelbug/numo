<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Students;
use Illuminate\Http\Request;
use Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(!$request->user()->tokenCan('students:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $students = Students::all();
        return [
          'success' => true,
          'status' => 201 ,
          'data' => $students
      ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function login(Request $request)
     {

       if (!Auth::guard('students')->attempt([
         'email' => $request->email ,
         'password' => $request->password
         ])) {
         return response()->json([
           'e' => $request->email,
           'success' => false,
           'status' => 404
         ]);
       }

       $students = auth()->guard('students')->user();

        $str = ["carts:*",
        "carts_details:*","courses:read",
        "exams:read","exam_questions_anwser_choices:read",
        "exam_questions_anwser_writes:read",
        "questionnaires:read",
        "order_payments:*",
        "order_payment_details:*",
        "unit_videos:read",
        "students:update",
        "students:read"
        ];
        if( count($str) == 0 ) { $str = ["*"]; }
       $token = $students->createToken($request->email, $str)->plainTextToken;
       return response()->json([
         'success' => true,
         'status' => 201 ,
         'data' => $token,
         'D' => $students,
       ]);
     }


     public function active(Request $request, $students)
     {
      if(!$request->user()->tokenCan('students:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }

      $request->validate([
        'status' => 'required|max:100'
      ]);
      $student = Students::where('id', $students)->update(
        [
          'status' =>$request->status,
          'actived_by_id' => $request->user()->id
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
      $request->validate([
        'first_name' => 'required|max:100',
        'password' => 'required|max:100',
        'last_name' => 'required|max:100',
        'email' => 'required|unique:students|max:100',
        'phone' => 'max:100|nullable',
      ]);
      $request->password = Hash::make($request->password);

      $students = Students::create(
        array_merge($request->all(),[
          'password' =>$request->password
         ]),
      );
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => $students
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Students $students)
    {
      if(!$request->user()->tokenCan('students:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => $students
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function editupload(Request $request, Students $students)
    {
      if(!$request->user()->tokenCan('students:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }

      if(!$request->user()->rolls && $request->user()->id != $students->id ){
        return response()->json([
          'msg' => 'not access for this',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'image' => 'nullable',
        'imagecertificated' => 'nullable',
        'imagenationalid' => 'nullable',
      ]);
      if($request->hasfile('image')) {
        $file = $request->file('image');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path('/uploads/user/'), $name);
        $l = 'uploads/user/'.$name;
        $student = Students::where('id', $students->id)->update([
          "image" => $l
        ]);
      }
      if($request->hasfile('imagecertificated')) {
        $file = $request->file('imagecertificated');
        $nameimagecertificated = time().$file->getClientOriginalName();
        $file->move(public_path('/uploads/user/'), $nameimagecertificated);
        $l = 'uploads/user/'.$nameimagecertificated;
        $student = Students::where('id', $students->id)->update([
          "imagecertificated" => $l
        ]);
      }
      if($request->hasfile('imagenationalid')) {
        $file = $request->file('imagenationalid');
        $nameimagenationalid = time().$file->getClientOriginalName();
        $file->move(public_path('/uploads/user/'), $nameimagenationalid);
        $l = 'uploads/user/'.$nameimagenationalid;
        $student = Students::where('id', $students->id)->update([
          "imagenationalid" => $l
        ]);
      }
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'update'
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $students)
    {
      if(!$request->user()->tokenCan('students:read')){
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
          'email' => 'required|unique:students,email,'.$students->id.'|max:100',
          'phone' => 'max:100|nullable',
        ]);
        $request->password = Hash::make($request->password);
        $student = Students::where('id', $students->id)->update(
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
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Students $students)
    {
      if(!$request->user()->tokenCan('students:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $students->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);
    }
}
