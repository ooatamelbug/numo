<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use Illuminate\Http\Request;
use App\Models\CartsDetails;
use App\Models\CoursesDetails;
use App\Models\Courses;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = $request->user()->id;
      if(!$request->user()->tokenCan('carts:*')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $cart = Carts::where('status', 0)->where('student_id', $user)->get()->first();
      $d = CartsDetails::join(

          "courses","courses.id", "=" , "carts_details.course_id"
      )->select(
        "carts_details.*",
        "courses.*"
      )
      ->where('cart_id', $cart->id )->get();
      $cart->cartsdetails = $d;
      return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => $cart
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
        if(!$request->user()->tokenCan('carts:*')){
          return response()->json([
            'msg' => 'not access',
            'success' => false,
            'status' => 401
          ]);
        }
        $request->validate([
          'course_id' => 'max:100|nullable'
        ]);
        $c = Courses::where('id' ,$request->course_id)->get()->first();
        if(!$c){
          return response()->json([
            'msg' => 'Course not exist',
            'success' => false,
            'status' => 404
          ]);
        }
        $user = $request->user()->id;
        $cart = Carts::where('status', 0)->where('student_id', $user)->get()->first();

        if(!$cart){
          $carts = Carts::create(
            [
              'total_price' => 0,
              'total_units' => 0,
              'status' => 0,
              'student_id' => $request->user()->id
            ]
          );
        }

        if($request->course_id){
          $c = Courses::where('id' ,$request->course_id)->get()->first();
          $cartd = Carts::where('status', 0)->where('student_id', $user)->get()->first();
          $e = CartsDetails::where('cart_id',$cartd->id)
          ->where('course_id', $request->course_id)
          ->get();
          if($e && count($e) != 0){
            return response()->json([
              'msg' => 'Course is exist in cart',
              'success' => false,
              'status' => 404
            ]);
          }
          // code...
          $cart = Carts::where('id', $cartd->id)->where('student_id',$user)->update(
            [
              "total_price" => ($cartd->total_price + ($c->price - $c->discount )),
              "total_units" => ($cartd->total_units + 1),
              "student_id" => $user
            ]
          );
          $cd = CartsDetails::create([
            "course_id" => $request->course_id,
            "cart_id" => $cartd->id,
          ]);
        }
        return response()->json([
          'success' => true,
          'status' => 201 ,
          'data' => "added"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show(Carts $carts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(Carts $carts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carts $carts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
      if(!$request->user()->tokenCan('carts:*')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $user = $request->user()->id;
      $carts = Carts::where('status', 0)->where('student_id', $user)->get()->first();

      $cart = Carts::where('id', $carts->id)->where('student_id',$user)->update(
        [
          "total_price" => 0,
          "student_id" => $user,
          "total_units" => 0
        ]
      );
      $cartd =  CartsDetails::where('cart_id',$carts->id)->get();
      for ($i=0; $i < count($cartd) ; $i++) {
        // code...
        $cartd[$i]->delete();
      }
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);

    }
}
