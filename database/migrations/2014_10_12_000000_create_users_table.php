<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->integer('student_id');
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
      $table->integer('phone_number')->nullable();
      $table->string('username')->nullable();
      $table->integer('height')->nullable();
      $table->integer('weight')->nullable();
      $table->string('gender')->nullable(); // L, P
      $table->string('address')->nullable();
      $table->dateTime('birth')->nullable();
      $table->string('avatar')->nullable()->default('/avatar/guest.png');
      $table->string('religion')->nullable();
      $table->string('love_language')->nullable();
      $table->string('bio')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
