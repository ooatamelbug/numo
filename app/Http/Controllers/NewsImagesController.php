<?php

namespace App\Http\Controllers;

use App\Models\NewsImages;
use Illuminate\Http\Request;

class NewsImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsImages  $newsImages
     * @return \Illuminate\Http\Response
     */
    public function show(NewsImages $newsImages)
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
        'ranged' => 'required',
        'link' => 'required|image|array'
      ]);
      if($request->hasfile('filenames'))
       {
          foreach($request->file('filenames') as $file)
          {
              $name = time().rand(1,100).'.'.$file->extension();
              $file->move(public_path('files'), $name);
              $files[] = $name;
          }
       }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsImages  $newsImages
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsImages $newsImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewsImages  $newsImages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsImages $newsImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsImages  $newsImages
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsImages $newsImages)
    {
        //
    }
}
