<?php

namespace App\Http\Controllers;
use App\Models\Carts;
use App\Models\Courses;

use App\Models\CartsDetails;
use Illuminate\Http\Request;

class CartsDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $cart)
    {
      if(!$request->user()->tokenCan('carts:*')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $cartd =  CartsDetails::join(

          "courses","courses.id", "=" , "carts_details.course_id"
      )->select(
        "carts_details.*",
        "courses.*"
      )->where('cart_id',$cart)->get();
      return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => $cartd
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

      return response()->json([
        'success' => true,
        'status' => 201 ,
        'data' => "added"
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartsDetails  $cartsDetails
     * @return \Illuminate\Http\Response
     */
    public function show(CartsDetails $cartsDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartsDetails  $cartsDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(CartsDetails $cartsDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartsDetails  $cartsDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartsDetails $cartsDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartsDetails  $cartsDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CartsDetails $cartsDetails)
    {
      $user = $request->user()->id;
      if(!$request->user()->tokenCan('carts:*')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $c = Courses::where('id' ,$cartsDetails->course_id)->get()->first();
      $cart = Carts::where('status', 0)->where('student_id', $user)->get()->first();

      $cartu = Carts::where('status', 0)->where('student_id', $user)->update(
        [
          'total_price' => ($cart->total_price - ($c->price - $c->discount)),
          'total_units' => ($cart->total_units -1),
          'status' => 0,
          'student_id' => $request->user()->id
        ]
      );

      $cartsDetails->delete();
        return response()->json([
          'success' => true,
          'status' => 200 ,
          'data' => 'yes'
        ]);
    }
}
