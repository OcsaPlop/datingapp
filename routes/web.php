<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::middleware(['guest'])->group(function () {
  Route::inertia('/login', 'Login')->name('login');
  Route::inertia('/register', 'Register');

  Route::post('/register', [AuthController::class, 'register']);
  Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth:web'])->group(function () {
  Route::redirect('/home', '/');
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::inertia('/', 'Index');
  Route::post('/update', [UserController::class, 'update']);
  Route::get('/profile', function () {
    $user = Auth::user();
    return Inertia::render('Profile', [
      'user' => [
        'name' => $user->name,
        'username' => $user->username,
        'address' => $user->address,
        'height' => $user->height,
        'weight' => $user->weight,
        'gender' => $user->gender,
        'email' => $user->email,
        'phoneNumber' => $user->phone_number,
        'avatar' => $user->avatar,
        'birth' => $user->birth,
        'religion' => $user->religion,
        'loveLanguage' => $user->love_language,
        'bio' => $user->bio,
      ],
    ]);
  });
});
