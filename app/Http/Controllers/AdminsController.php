<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Admins;
use App\Models\PermisionsAdmins;
use Illuminate\Http\Request;
use Auth;
class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if(!$request->user()->tokenCan('admins:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $admins = Admins::all();
        return [
          'success' => true,
          'status' => 201 ,
          'data' => $admins
      ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
      if (!Auth::guard('admins')->attempt([
        'email' => $request->email ,
        'password' => $request->password
        ])) {
        return response()->json([
          'e' => $request->email,
          'success' => false,
          'status' => 404
        ]);
      }

      $admin = auth()->guard('admins')->user();
      $permisionsAdmins = PermisionsAdmins::
      join('permisions', 'permisions.id','=', 'permisions_admins.permision_id')
     ->select('permisions.title as title')
     ->where(
         'admin_id', $admin->id
       )->get();
       $str = [];
       for ($i=0; $i < count($permisionsAdmins); $i++) {
         // code...
         $str[$i] = $permisionsAdmins[$i]->title;
       }
       if( count($str) == 0 ) { $str = ["*"]; }
      $token = $admin->createToken($request->email, $str)->plainTextToken;
      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => $token,
        'D' => $admin,
      ]);
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
          'first_name' => 'required|max:100',
          'password' => 'required|max:100',
          'last_name' => 'required|max:100',
          'email' => 'required|unique:admins|max:100',
          'phone' => 'max:100|nullable',
          'image' => 'max:100|nullable',
          'rolls' => 'required|max:100'
        ]);
        $request->password = Hash::make($request->password);

        $admins = Admins::create(
          array_merge($request->all(),['password' =>$request->password ]),
        );
        return response()->json([
          'success' => true,
          'status' => 201 ,
          'data' => $admins
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Admins $admins)
    {
        if(!$request->user()->tokenCan('admins:read')){
          return response()->json([
            'msg' => 'not access',
            'success' => false,
            'status' => 401
          ]);
        }
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => $admins
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admins $admins)
    {
        if(!$request->user()->tokenCan('admins:update')){
          return response()->json([
            'msg' => 'not access',
            'success' => false,
            'status' => 401
          ]);
        }
        $request->validate([
          'first_name' => 'required|max:100',
          'password' => 'required|max:100',
          'last_name' => 'required|max:100',
          'email' => 'required|unique:admins,email,'.$admins->id.'|max:100',
          'phone' => 'max:100|nullable',
          'image' => 'max:100|nullable',
          'rolls' => 'required|max:100'
        ]);
        $request->password = Hash::make($request->password);
        $admin = Admins::where('id', $admins->id)->update(
          array_merge($request->all(),['password' =>$request->password ]),
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
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Admins $admins)
    {
      if(!$request->user()->tokenCan('admins:delete')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $admins->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);
    }
}
