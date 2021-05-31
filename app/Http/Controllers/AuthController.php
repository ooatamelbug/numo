<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function logout(Request $request)
  {
    auth()->user()->token()->delete();

    return [
      'msg' => 'log out'
    ]
  }
}
