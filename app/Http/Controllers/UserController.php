<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
  public function update(UpdateUserRequest $request)
  {
    $user = $request->user();
    $user->name = $request->name;
    $user->address = $request->address;
    $user->gender = $request->gender;
    $user->birth = $request->birth;
    $user->height = $request->height;
    $user->weight = $request->weight;
    $user->phone_number = $request->phone_number;
    $user->username = $request->username;
    $user->religion = $request->religion;
    $user->love_language = $request->love_language;
    $user->bio = htmlspecialchars($request->bio);
    if ($request->hasFile('avatar')) {
      $avatarName = $user->id . '.' . $request->file('avatar')->extension();
      $request->file('avatar')->move(public_path('avatar'), $avatarName);
      $user->avatar = '/avatar/' . $avatarName . '#' . time();
    }
    $user->save();
    return back();
  }
}
