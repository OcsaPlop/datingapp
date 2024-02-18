<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'name' => $this->name,
      'username' => $this->username,
      'address' => $this->address,
      'height' => $this->height,
      'weight' => $this->weight,
      'gender' => $this->gender,
      'email' => $this->email,
      'phoneNumber' => $this->phone_number,
      'avatar' => $this->avatar,
      'birth' => $this->birth,
      'religion' => $this->religion,
      'loveLanguage' => $this->love_language,
      'bio' => $this->bio,
    ];
  }
}
