<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait ChatQueries
{

    public static function InsertIFNotExistsAndGetId(string $receiver_id , $values)
    {
        $chat_id = self::getChatById($receiver_id)?->id;
        return $chat_id ??= static::insertGetId($values);
    }

    public static function getChatById(string $receiver_id)
    {
        return static::where(function ($query) use ($receiver_id) {
            $query->where('receiver_id', $receiver_id)
            ->where('sender_id', Auth::id());
            })->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)
                    ->where('receiver_id', Auth::id());
            })->first();
    }

}
