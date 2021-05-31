<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestionsType;
use Illuminate\Http\Request;

class ExamQuestionsTypeController extends Controller
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
     * @param  \App\Models\ExamQuestionsType  $examQuestionsType
     * @return \Illuminate\Http\Response
     */
    public function show(ExamQuestionsType $examQuestionsType)
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
     * @param  \App\Models\ExamQuestionsType  $examQuestionsType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamQuestionsType $examQuestionsType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamQuestionsType  $examQuestionsType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamQuestionsType $examQuestionsType)
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
     * @param  \App\Models\ExamQuestionsType  $examQuestionsType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamQuestionsType $examQuestionsType)
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
