<?php

namespace App\Http\Controllers;

use App\Models\UnitsFiles;
use Illuminate\Http\Request;
use App\Models\CoursesDetailsUnites;


class UnitsFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $units)
    {
      if(!$request->user()->tokenCan('unit_videos:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $f = UnitsFiles::where('unit_id', $units)->get();
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => $f
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
      if(!$request->user()->tokenCan('units_files:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $unit =CoursesDetailsUnites::find($request->unit_id);
      if(!$unit){
        return response()->json([
          'msg' => 'not found',
          'success' => false,
          'status' => 404
        ]);
      }
      $request->validate([
        'name' => 'required',
        'unit_id' => 'required|max:100'
      ]);

      if($request->hasfile('name')) {
        $file = $request->file('name');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path('/uploads/course/'), $name);
      }
      $l = 'uploads/course/'.$name;
      $course = UnitsFiles::create(
        array_merge($request->all(),[
          'name' => $l
        ])
      );
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'added'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitsFiles  $unitsFiles
     * @return \Illuminate\Http\Response
     */
    public function show(UnitsFiles $unitsFiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitsFiles  $unitsFiles
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitsFiles $unitsFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitsFiles  $unitsFiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitsFiles $unitsFiles)
    {
      if(!$request->user()->tokenCan('admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'name' => 'nullable',
        'unit_id' => 'required|max:100'
      ]);

      if($request->hasfile('name')) {
        $file = $request->file('name');
        $name = time().$file->getClientOriginalName();
        $file->move(public_path('/uploads/course/'), $name);
      }
      $l = $request->hasfile('name') ? '/uploads/course/'.$name : $unitsFiles->name;
      $course = UnitsFiles::where('id',$unitsFiles->id)->update(
        array_merge($request->all(),[
          "name" => $l
        ])
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
     * @param  \App\Models\UnitsFiles  $unitsFiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UnitsFiles $unitsFiles)
    {
      if(!$request->user()->tokenCan('admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $unitsFiles->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);
    }
}
