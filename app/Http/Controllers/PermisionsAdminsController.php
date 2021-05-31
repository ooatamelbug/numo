<?php

namespace App\Http\Controllers;

use App\Models\PermisionsAdmins;
use Illuminate\Http\Request;

class PermisionsAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(!$request->user()->tokenCan('permisions_admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $permisions = PermisionsAdmins::
        join('admins', 'admins.id', '=', 'permisions_admins.admin_id')
        ->join('admins as ad', 'ad.id', '=', 'permisions_admins.actived_by_id')
        ->join('permisions', 'permisions.id', '=', 'permisions_admins.permision_id')
        ->select('permisions_admins.*', 'admins.first_name as admin',
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
      if(!$request->user()->tokenCan('permisions_admins:create')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }

      $request->validate([
        'actived_by_id' => 'required|max:100',
        'permision_id' => 'required|array|min:1',
        'admin_id' => 'required|max:100'
      ]);
      for ($i=0; $i < count($request->permision_id); $i++) {
        // code...
        $permisionsAdmins = PermisionsAdmins::create([
          'permision_id' => $request->permision_id[$i],
          'actived_by_id' => $request->actived_by_id,
          'admin_id' => $request->admin_id
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
     * @param  \App\Models\PermisionsAdmins  $permisionsAdmins
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $admins)
    {
      if(!$request->user()->tokenCan('permisions_admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $permisions = PermisionsAdmins::
        join('admins', 'admins.id', '=', 'permisions_admins.admin_id')
        ->join('admins as ad', 'ad.id', '=', 'permisions_admins.actived_by_id')
        ->join('permisions', 'permisions.id', '=', 'permisions_admins.permision_id')
        ->select('permisions_admins.*', 'admins.first_name as admin',
         'ad.first_name as actived_by',
         'permisions.title as permision')
         ->where('admin_id', $admins)
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
     * @param  \App\Models\PermisionsAdmins  $permisionsAdmins
     * @return \Illuminate\Http\Response
     */
    public function edit(PermisionsAdmins $permisionsAdmins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermisionsAdmins  $permisionsAdmins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermisionsAdmins $permisionsAdmins)
    {
      if(!$request->user()->tokenCan('permisions_admins:update')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }

      $request->validate([
        'actived_by_id' => 'required|max:100',
        'permision_id' => 'required|array|min:1',
        'admin_id' => 'required|max:100'
      ]);
      $admins = PermisionsAdmins::find($request->admin_id);
      if(!$admins){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 404
        ]);
      }else {
        $p = PermisionsAdmins::where('admin_id', $request->admin_id)->get();
        for ($z=0; $z < count($p); $z++) {
            $p[$z]->delete();
          // code...
        }
      }

      for ($i=0; $i < count($request->permision_id); $i++) {
        // code...
        $permisionsAdmins = PermisionsAdmins::create([
          'permision_id' => $request->permision_id[$i],
          'actived_by_id' => $request->actived_by_id,
          'admin_id' => $request->admin_id
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
     * @param  \App\Models\PermisionsAdmins  $permisionsAdmins
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PermisionsAdmins $permisionsAdmins)
    {
      if(!$request->user()->tokenCan('permisions_admins:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $permisionsAdmins->delete();
        return [
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ];
    }
}
