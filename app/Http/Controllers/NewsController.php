<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\NewsImages;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $news = News::all();
      return response()->json([
        'msg' => '',
        'success' => true,
        'status' => 200,
        'data' => $news
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
        'title_slug' => 'required|min:3|unique:news',
        'body' => 'required|min:3',
        'images' => [
          'name' => 'required|image',
          'link' => 'required',
          'ranged' => 'required'
        ]
      ]);
      $news = News::create([
          'title' => $request->title,
          'title_slug' => $request->title_slug,
          'body' => $request->desc,
          'admin_id' => $request->user()->id,
          'status' => 1
        ]);
        for ($i=0; $i < count($request->images); $i++) {
          $image = NewsImages::create([
              'news_id' => $news->id,
              'name' => $request->images->name,
              'link' => $request->images->link,
              'ranged' => $request->images->ranged
          ]);
        }

      return response()->json([
          'success' => true,
          'status' => 201 ,
          'data' => $news
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
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
        'title_slug' => 'required|min:3|unique:news',
        'body' => 'nullable',
        'status' => 'nullable',
      ]);
      $news = News::update([
          'title' => $request->title,
          'title_slug' => $request->title_slug,
          'body' => $request->desc,
          'admin_id' => $request->user()->id,
          'status' => $request->status
        ]);
      return response()->json([
          'success' => true,
          'status' => 201 ,
          'data' => $news
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, News $news)
    {
      if(!$request->user()->tokenCan('admins:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $images = NewsImages::where('news_id', $news->id);
      for ($i=0; $i < count($images) ; $i++) {
        // code...
        $images[$i]->delete();
      }
      $news->delete();
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'yes'
      ]);
    }
}
