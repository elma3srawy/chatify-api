<?php

namespace App\Http\Controllers\Api\Auth;

use App\Auth\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{

    public function __construct(private Authenticate $auth){}

    public function register(RegisterRequest $request): JsonResponse
    {
        $token = $this->auth->register($request);

        return response()->json([
            'message' => 'Registered successfully',
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->auth->login($request);

        return response()->json([
            'message' => 'Logged in successfully',
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->auth->logout($request);

        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }
}