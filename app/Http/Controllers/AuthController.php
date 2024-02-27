<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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

    return Inertia::location('https://www.youtube.com/watch?v=UIp6_0kct_U');
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/login');
  }
}
