<?php

namespace App\Models;

use App\Traits\ChatQueries;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use ChatQueries;

    protected $fillable = [
        'receiver_id',
        'sender_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function messages()
    {
        return $this->hasMany(related: Message::class);
    }

}
