<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\UserController;
use App\Http\Resources\ChatRoomResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\ChatRoom;
use App\Models\User;
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
  Route::get('/', function () {
    $auth = Auth::user();
    $rooms = ChatRoom::where('user1_id', $auth->id)
      ->orWhere('user2_id', $auth->id)
      ->orderByDesc('updated_at')
      ->get();
    return Inertia::render('Index', [
      'rooms' => ChatRoomResource::collection($rooms),
    ]);
  });
  Route::post('/update', [UserController::class, 'update']);
  Route::get('/profile', function () {
    $user = Auth::user();
    return Inertia::render('Profile', ['user' => new ProfileResource($user)]);
  });
  Route::get('/search', function () {
    $user = Auth::user();
    if ($user->address && $user->height && $user->weight && $user->gender && $user->love_language && $user->religion) {
      $oppositeGenderUser = User::where('gender', '!=', $user->gender)
        ->inRandomOrder()
        ->first();
      if (!$oppositeGenderUser) {
        return Inertia::location('/');
      }
      return Inertia::render('Search', ['user' => new UserResource($oppositeGenderUser)]);
    }
    return Inertia::location('/profile');
  });
  Route::get('/{username}', [ChatMessageController::class, 'receiveMessage']);
  Route::post('/send/{username}', [ChatMessageController::class, 'sendMessage']);
});
