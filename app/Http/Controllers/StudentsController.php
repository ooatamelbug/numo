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
      if(!$request->user()->tokenCan('admins:read')){
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
      //  $permisionsAdmins = PermisionsAdmins::
      //  join('permisions', 'permisions.id','=', 'permisions_admins.permision_id')
      // ->select('permisions.title as title')
      // ->where(
      //     'admin_id', $admin->id
      //   )->get();
        $str = ["carts.*",
        "carts_details.*","courses.read",
        "exams.read","exam_questions_anwser_choices.read",
        "exam_questions_anwser_writes.read",
        "questionnaires.read",
        "order_payments.*",
        "order_payment_details.*",
        "unit_videos.read",
        ];
        // for ($i=0; $i < count($permisionsAdmins); $i++) {
          // code...
          // $str[$i] = $permisionsAdmins[$i]->title;
        // }
        if( count($str) == 0 ) { $str = ["*"]; }
       $token = $students->createToken($request->email, $str)->plainTextToken;
       return response()->json([
         'success' => true,
         'status' => 201 ,
         'data' => $token,
         'D' => $students,
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
        'email' => 'required|unique:admins|max:100',
        'phone' => 'max:100|nullable',
        'image' => 'max:100|nullable',
        'rolls' => 'required|max:100'
      ]);
      $request->password = Hash::make($request->password);

      $students = Students::create(
        array_merge($request->all(),['password' =>$request->password ]),
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
      if(!$request->user()->rolls || $request->user()->id != $students->id ){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'image' => 'nullable|max:100',
        'imagecertificated' => 'nullable|max:100',
        'imagenationalid' => 'nullable|max:100',
      ]);
      if($request->hasfile('image')) {
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/uploads/', $name);
        $student = Students::where('id', $students->id)->update([
          "image" => $name
        ]);
      }
      if($request->hasfile('imagecertificated')) {
        $file = $request->file('imagecertificated');
        $nameimagecertificated = $file->getClientOriginalName();
        $file->move(public_path().'/uploads/', $nameimagecertificated);
        $student = Students::where('id', $students->id)->update([
          "imagecertificated" => $nameimagecertificated
        ]);
      }
      if($request->hasfile('imagenationalid')) {
        $file = $request->file('imagenationalid');
        $nameimagenationalid = $file->getClientOriginalName();
        $file->move(public_path().'/uploads/', $nameimagenationalid);
        $student = Students::where('id', $students->id)->update([
          "imagenationalid" => $nameimagenationalid
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
        $request->validate([
          'first_name' => 'required|max:100',
          'password' => 'required|max:100',
          'last_name' => 'required|max:100',
          'email' => 'required|unique:students,email,'.$admins->id.'|max:100',
          'phone' => 'max:100|nullable',
          'image' => 'max:100|nullable',
        ]);
        $request->password = Hash::make($request->password);
        $student = Admins::where('id', $students->id)->update(
          array_merge($request->all(),['password' =>$request->password ]),
        );
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'update'
        ]);
      }
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
