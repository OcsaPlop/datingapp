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

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */

  public function messages(): array
  {
    return [
      'name.required' => 'Mohon isi nama Anda.',
      'name.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
      'studentId.required' => 'Mohon isi Nomor Induk Mahasiswa Anda.',
      'studentId.integer' => 'Nomor Induk Mahasiswa harus berupa bilangan bulat.',
      'email.required' => 'Mohon isi alamat email Anda.',
      'email.email' => 'Alamat email Anda tidak valid.',
      'email.unique' => 'Alamat email ini sudah digunakan. Silakan gunakan alamat email lain.',
      'password.required' => 'Mohon isi sandi Anda.',
      'password.min' => 'Sandi Anda harus memiliki minimal :min karakter.',
    ];
  }

}
