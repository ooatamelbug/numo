<?php

namespace App\Http\Controllers;

use App\Models\CoursesSubscriptions;
use Illuminate\Http\Request;
use App\Models\OrderPaymentDetails;
use App\Models\OrderPayment;

class CoursesSubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(!$request->user()->tokenCan('courses_subscriptions:read')){
        return response()->json([
          'msg' => 'not access',
          'success' => false,
          'status' => 401
        ]);
      }
      $subscriptions = CoursesSubscriptions::join(
        'courses','courses.id' ,'=' , 'courses_subscriptions.course_id'
        )->join(
          'students','students.id' ,'=' , 'courses_subscriptions.student_id'
        )->select(
          "courses_subscriptions.*",
          "courses.title as course",
          "students.firstname as firstname",
          "students.lastname as lastname",
        )->get();
        return response()->json([
            'success' => true,
            'status' => 200 ,
            'data' => $subscriptions
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
    public function store( $order)
    {
      $orderget = OrderPayment::find($order);
      $d = OrderPaymentDetails::where('order_payment_id', $order)->get();
      for ($i=0; $i < count($d) ; $i++) {
        // code...
        $subscription = CoursesSubscriptions::create([
          'order_payments' => $order,
          'course_id' => $d[$i]->course_id,
          'student_id' => $orderget->student_id
        ]);
      }
      return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoursesSubscriptions  $coursesSubscriptions
     * @return \Illuminate\Http\Response
     */
    public function show(CoursesSubscriptions $coursesSubscriptions)
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
     * @param  \App\Models\CoursesSubscriptions  $coursesSubscriptions
     * @return \Illuminate\Http\Response
     */
    public function edit(CoursesSubscriptions $coursesSubscriptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoursesSubscriptions  $coursesSubscriptions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoursesSubscriptions $coursesSubscriptions)
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoursesSubscriptions  $coursesSubscriptions
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoursesSubscriptions $coursesSubscriptions)
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
