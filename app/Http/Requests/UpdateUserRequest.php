<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    $user = $this->user();
    return $user !== null;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
      'address' => ['required'],
      'gender' => ['required', Rule::in(['L', 'P'])],
      'birth' => ['required'],
      'height' => ['required'],
      'weight' => ['required'],
      'phoneNumber' => ['required'],
      'username' => ['required', Rule::unique('users', 'username')->ignore(auth()->user()->id)],
      'religion' => ['required'],
      'loveLanguage' => ['required'],
      'avatar' => ['sometimes', 'nullable', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
      'bio' => ['sometimes', 'nullable'],
    ];
  }
  protected function prepareForValidation()
  {
    $this->merge([
      'phone_number' => $this->phoneNumber,
      'love_language' => $this->loveLanguage,
    ]);
  }
}
