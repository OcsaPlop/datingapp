<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * The current password being used by the factory.
   */
  protected static ?string $password;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $studentId = random_int(10000000000000, 99999999999999);
    $gender = $this->faker->randomElement(['L', 'P']);
    $height = rand(144, 180);
    $weight = rand(46, 81);
    $loveLanguage = $this->faker->randomElement(['Acts of Service', 'Words of Affirmation', 'Quality Time', 'Physical Touch', 'Receiving Gift']);
    $religion = $this->faker->randomElement(['Muslim', 'Protestant', 'Catholic', 'Hindu', 'Buddhist', 'Confucian']);

    return [
      'name' => fake()->name(),
      'email' => fake()->unique()->safeEmail(),
      'email_verified_at' => now(),
      'password' => static::$password ??= Hash::make('password'),
      'remember_token' => Str::random(10),
      'student_id' => $studentId,
      'gender' => $gender,
      'phone_number' => fake()->phoneNumber,
      'username' => fake()->userName,
      'height' => $height,
      'weight' => $weight,
      'address' => fake()->address,
      'birth' => fake()->dateTimeThisCentury,
      'avatar' => '/avatar/guest.png',
      'religion' => $religion,
      'love_language' => $loveLanguage,
      'bio' => fake()->realText,
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static
  {
    return $this->state(fn(array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}
