<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function register(RegisterRequest $request)
  {
    $user = User::create($request->all());
    Auth::login($user);
    return redirect('/profile');
  }

  public function login(LoginRequest $request)
  {
    if (Auth::attempt($request->all())) {
      $request->session()->regenerate();
      return redirect('/');
    }

    return abort(400);
  }

  public function logout()
  {
    Auth::logout();
  }
}
