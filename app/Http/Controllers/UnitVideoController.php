<?php

namespace App\Http\Controllers;

use App\Models\UnitVideo;
use Illuminate\Http\Request;
use App\Models\CoursesDetailsUnites;

class UnitVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $units )
    {
      if(!$request->user()->tokenCan('unit_videos:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }

      $v = UnitVideo::where('unit_id', $units)->get();
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => $v
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
      if(!$request->user()->tokenCan('unit_videos:create')){
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
        'name' => 'required|max:100',
        'unit_id' => 'required|max:100'
      ]);


      $course = UnitVideo::create(
        array_merge($request->all())
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
     * @param  \App\Models\UnitVideo  $unitVideo
     * @return \Illuminate\Http\Response
     */
    public function show(UnitVideo $unitVideo)
    {
      if(!$request->user()->tokenCan('admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitVideo  $unitVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitVideo $unitVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitVideo  $unitVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitVideo $unitVideo)
    {
      if(!$request->user()->tokenCan('admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'name' => 'required|max:100',
        'unit_id' => 'required|max:100'
      ]);


      $course = UnitVideo::where('id',$unitVideo->id)->update(
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
     * @param  \App\Models\UnitVideo  $unitVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UnitVideo $unitVideo)
    {
      if(!$request->user()->tokenCan('unit_videos:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $unitVideo->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);
    }
}
