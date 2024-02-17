<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
      'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
      'studentId' => ['required', 'integer'],
      'email' => ['email', 'required', Rule::unique('users', 'email')],
      'password' => ['required', 'min: 8'],
    ];
  }

  protected function prepareForValidation()
  {
    $this->merge([
      'student_id' => $this->studentId,
    ]);
  }
}
