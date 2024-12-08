<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $token = $this->authService->storeUser($data);
        return response()->json([
            'message' => 'Usuário criado com sucesso.',
            'user' => $data,
        ], 201);
    }


    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $token = $this->authService->login($data);
        return new LoginResource($token);
    }
}
