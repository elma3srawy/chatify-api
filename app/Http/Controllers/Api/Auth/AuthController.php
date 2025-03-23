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
        return $this->auth->register($request);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->auth->login($request);
    }

    public function logout(Request $request): JsonResponse
    {
        return  $this->auth->logout($request);
    }
}
