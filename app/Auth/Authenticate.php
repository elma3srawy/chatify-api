<?php

namespace App\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface Authenticate
{
    public function register(Request $request):JsonResponse;
    public function login(Request $request):JsonResponse;
    public function logout(Request $request):JsonResponse;
}
