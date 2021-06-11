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
    public function store(Request $request, $new)
    {
      if(!$request->user()->tokenCan('news_images:create')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
          'imagesFiles' => 'required',
          'imagesFiles.*' => 'mimes:jpeg,jpg,png,gif|max:4048'
      ]);
      $images = NewsImages::where('news_id', $new)->get();
      $c = count($images) > 0 ? count($images) : 1 ;
      $f =$request->file('imagesFiles');
      if($f){
        $i = $c - 1;
        foreach($request->file('imagesFiles') as $file){
          $name = time().rand(1,100).'.'.$file->getClientOriginalExtension();
          $file->move(public_path('/uploads/news'), $name);
          $link = "uploads/news/".$name;
          $image = NewsImages::create([
              'news_id' => $new,
              'link' =>  $link,
              'title' => $name,
              'ranged' => ($i +1)
            ]);
            $i++;
          }
        }
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'update'
        ]);
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
      if(!$request->user()->tokenCan('news_images:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'title' => 'required',
        'ranged' => 'required',
        'news_id' => 'required',
        'link' => 'required'
      ]);
      $newsImages = NewsImages::where('id', $newsImages->id)
      ->update($request->all());
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'update'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsImages  $newsImages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,NewsImages $newsImages)
    {
      if(!$request->user()->tokenCan('news_images:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $newsImages->delete();
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'yes'
      ]);
    }
}
