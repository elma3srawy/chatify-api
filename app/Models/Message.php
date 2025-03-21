<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

   protected $fillable = [
        'chat_id',
        'content',
        'sender_id',
        'status',
        'read_at'
   ];

   public function chat()
   {
        return $this->belongsTo(Chat::class);
   }
}
