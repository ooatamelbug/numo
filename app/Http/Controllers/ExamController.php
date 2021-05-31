<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
      if(!$request->user()->tokenCan('admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
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
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
      if(!$request->user()->tokenCan('admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
    }
}
