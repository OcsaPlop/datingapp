<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    $user = $this->user;
    return $user === null;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'email' => ['email', 'required'],
      'password' => ['required', 'min: 8'],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'email.required' => 'Mohon isi email Anda.',
      'email.email' => 'Alamat email Anda tidak valid.',
      'password.required' => 'Mohon isi sandi Anda',
      'password.min' => 'Sandi Anda harus memiliki minimal :min karakter.',
    ];
  }
}
