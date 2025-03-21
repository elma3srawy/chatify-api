<?php

namespace App\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class SanctumAuth implements Authenticate
{
    public function register(Request $request): string
    {
        $user =  User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
            ]
        );

        return  $user->createToken('user' , ['user'])->plainTextToken;
    }

    public function login(Request $request): string
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return  $user->createToken('user' , ['user'])->plainTextToken;
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }

}
