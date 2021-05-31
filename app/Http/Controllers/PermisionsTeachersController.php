<?php

namespace App\Http\Controllers;

use App\Models\PermisionsTeachers;
use Illuminate\Http\Request;

class PermisionsTeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!$request->user()->tokenCan('permisions_teachers:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $permisions = PermisionsTeachers::
        join('teachers', 'teachers.id', '=', 'PermisionsTeachers.teacher_id')
        ->join('admins as ad', 'ad.id', '=', 'PermisionsTeachers.actived_by_id')
        ->join('permisions', 'permisions.id', '=', 'PermisionsTeachers.permision_id')
        ->select('PermisionsTeachers.*', 'teachers.first_name as teacher',
         'ad.first_name as actived_by',
         'permisions.title as permision')
        ->get();
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => $permisions
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
      if(!$request->user()->tokenCan('permisions_teachers:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        "role" => 'nullable',
        'actived_by_id' => 'required|max:100',
        'permision_id' => 'required|array|min:1',
        'teacher_id' => 'required|max:100'
      ]);
      for ($i=0; $i < count($request->permision_id); $i++) {
        // code...
        $permisionsTeachers = PermisionsTeachers::create([
          'permision_id' => $request->permision_id[$i],
          'actived_by_id' => $request->actived_by_id,
          'teacher_id' => $request->teacher_id,
          'role' => $request->role
        ]);
      }
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => 'data'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PermisionsTeachers  $permisionsTeachers
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $teachers)
    {
      if(!$request->user()->tokenCan('permisions_teachers:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $permisions = PermisionsTeachers::
        join('teachers', 'teachers.id', '=', 'permisions_teachers.teacher_id')
        ->join('admins as ad', 'ad.id', '=', 'permisions_teachers.actived_by_id')
        ->join('permisions', 'permisions.id', '=', 'permisions_teachers.permision_id')
        ->select('permisions_teachers.*', 'teachers.first_name as teacher',
         'ad.first_name as actived_by',
         'permisions.title as permision')
         ->where('teacher_id', $teachers)
        ->get();
        return response()->json([
          'success' => true,
          'status' => 201 ,
          'data' => $permisions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermisionsTeachers  $permisionsTeachers
     * @return \Illuminate\Http\Response
     */
    public function edit(PermisionsTeachers $permisionsTeachers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermisionsTeachers  $permisionsTeachers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermisionsTeachers $permisionsTeachers)
    {
      if(!$request->user()->tokenCan('permisions_teachers:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        "role" => 'nullable',
        'actived_by_id' => 'required|max:100',
        'permision_id' => 'required|array|min:1',
        'teacher_id' => 'required|max:100'
      ]);
      $teacher = PermisionsTeachers::find($request->admin_id);
      if(!$teacher){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 404
        ]);
      }else {
        $p = PermisionsTeachers::where('teacher_id', $request->admin_id)->get();
        for ($z=0; $z < count($p); $z++) {
            $p[$z]->delete();
          // code...
        }
      }

      for ($i=0; $i < count($request->permision_id); $i++) {
        // code...
        $permisionsAdmins = PermisionsTeachers::create([
          'permision_id' => $request->permision_id[$i],
          'actived_by_id' => $request->actived_by_id,
          'teacher_id' => $request->teacher_id,
          'role' => $request->role
        ]);
      }
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => 'data'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermisionsTeachers  $permisionsTeachers
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermisionsTeachers $permisionsTeachers)
    {
      if(!$request->user()->tokenCan('permisions_teachers:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
    }
}
