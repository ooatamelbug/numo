<?php

namespace App\Http\Controllers;

use App\Models\OrderPaymentDetails;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Carts;
use App\Controllers\CoursesSubscriptionsController;
use App\Models\CartsDetails;

class OrderPaymentController extends Controller
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
    public function create(Request $request)
    {
      $user = $request->user()->id;
      $cart = Carts::where('status', 0)->where('student_id', $user)->get()->first();
      if(!$cart){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $e = CartsDetails::where('cart_id',$cartd->id)
      ->where('course_id', $request->course_id)
      ->get();

      $order = OrderPayment::create([
        "total_price"  => $cart->total_price,
        "total_units"  => $cart->total_units,
        "student_id"  => $cart->student_id,
        "status" => 0,
        "operation_bank_id" => time().rand(1111,9999),
      ]);
      for ($i=0; $i < count($e) ; $i++) {
        // code...
        $cd = OrderPaymentDetails::create([
          "course_id" => $request->course_id,
          "order_payment_id" => $cartd->id,
        ]);
      }
      $cart->delete();
      return true;
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
     * @param  \App\Models\OrderPayment  $orderPayment
     * @return \Illuminate\Http\Response
     */
    public function show(OrderPayment $orderPayment)
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
     * @param  \App\Models\OrderPayment  $orderPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderPayment  $orderPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderPayment)
    {
      $order = OrderPayment::where('id',$orderPayment)
      ->where('status', 0)->get()->first();
      $u = OrderPaymentwhere('id',$orderPayment)
      ->where('status', 0)->update([
        'status' => 1
      ]);
      $subscription = CoursesSubscriptionsController($orderPayment);
      if($subscription){
        return true;
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderPayment  $orderPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderPayment $orderPayment)
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
