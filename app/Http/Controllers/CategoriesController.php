<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Categories::all();
      return response()->json([
        'msg' => '',
        'success' => true,
        'status' => 200,
        'data' => $categories
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
      if(!$request->user()->tokenCan('admins:create')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'title' => 'required|min:3',
        'title_slug' => 'required|min:3|unique:categories',
        'desc' => 'nullable',
      ]);
      $categories = Categories::create([
          'title' => $request->title,
          'title_slug' => $request->title_slug,
          'desc' => $request->desc,
          'admin_id' => $request->user()->id,
          'status' => 1
        ]);
      return response()->json([
          'success' => true,
          'status' => 201 ,
          'data' => $categories
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => $categories
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
      if(!$request->user()->tokenCan('admins:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }

      $request->validate([
        'title' => 'required|min:3',
        'title_slug' => 'required|min:3|unique:categories',
        'desc' => 'nullable',
        'status' => 'nullable',
      ]);
      $categories = Categories::update([
          'title' => $request->title,
          'title_slug' => $request->title_slug,
          'desc' => $request->desc,
          'admin_id' => $request->user()->id,
          'status' => $request->status
        ]);
      return response()->json([
          'success' => true,
          'status' => 201 ,
          'data' => $categories
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Categories $categories)
    {
      if(!$request->user()->tokenCan('admins:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $categories->delete();
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'yes'
      ]);
    }
}
