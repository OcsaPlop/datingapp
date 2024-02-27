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
      'address.required' => 'Mohon isi alamat Anda.',
      'gender.required' => 'Mohon pilih jenis kelamin Anda.',
      'gender.in' => 'Jenis kelamin harus diisi dengan "L" atau "P".',
      'birth.required' => 'Mohon isi tanggal lahir Anda.',
      'height.required' => 'Mohon isi tinggi badan Anda.',
      'weight.required' => 'Mohon isi berat badan Anda.',
      'phoneNumber.required' => 'Mohon isi nomor telepon Anda.',
      'username.required' => 'Mohon isi nama pengguna Anda.',
      'username.unique' => 'Nama pengguna ini sudah digunakan. Silakan pilih nama pengguna lain.',
      'religion.required' => 'Mohon pilih agama Anda.',
      'loveLanguage.required' => 'Mohon pilih bahasa cinta Anda.',
      'avatar.mimes' => 'Format avatar harus jpeg, png, jpg, atau webp.',
      'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 2MB.',
    ];
  }
}
