<?php

namespace App\Auth;

use Illuminate\Http\Request;

interface Authenticate
{
    public function register(Request $request): string;
    public function login(Request $request): string;
    public function logout(Request $request): void;
}
