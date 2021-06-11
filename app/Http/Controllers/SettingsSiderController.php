<?php

namespace App\Http\Controllers;

use App\Models\SettingsSider;
use Illuminate\Http\Request;

class SettingsSiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $siders = SettingsSider::all();
      return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => $siders
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
      if(!$request->user()->tokenCan('settings_siders:create')){
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
      $images = SettingsSider::all();
      $c = count($images) > 0 ? count($images) : 1 ;
      $f =$request->file('imagesFiles');
      $d = [];
      if($f){
        $i = $c - 1;
        foreach($request->file('imagesFiles') as $file){
          $name = time().rand(1,100).'.'.$file->getClientOriginalExtension();
          $file->move(public_path('/uploads/sider'), $name);
          $link = "uploads/sider/".$name;
          $image = SettingsSider::create([
              'link' =>  $link,
              'title' => $name,
              'ranged' => ($i +1)
            ]);
            $d[$i] = $link;
            $i++;
          }
        }
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'd' => $d,
          'data' => 'added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingsSider  $settingsSider
     * @return \Illuminate\Http\Response
     */
    public function show(SettingsSider $settingsSider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingsSider  $settingsSider
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingsSider $settingsSider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingsSider  $settingsSider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingsSider $settingsSider)
    {
      if(!$request->user()->tokenCan('settings_siders:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $request->validate([
        'title' => 'required',
        'ranged' => 'required',
        'link' => 'required'
      ]);
      $settingsSiders = SettingsSider::where('id', $settingsSider->id)
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
     * @param  \App\Models\SettingsSider  $settingsSider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,SettingsSider $settingsSider)
    {
      if(!$request->user()->tokenCan('settings_siders:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $settingsSider->delete();
      return response()->json([
        'success' => true,
        'status' => 200 ,
        'data' => 'yes'
      ]);
    }
}
