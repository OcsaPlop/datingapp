<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatRoom extends Model
{
  use HasFactory;

  protected $fillable = [
    'user1_id',
    'user2_id',
    'updated_at',
  ];

  public function user1(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user1_id');
  }

  public function user2(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user2_id');
  }
}
