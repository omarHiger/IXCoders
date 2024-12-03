<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function login(UserLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $user = User::where('email', $data['email'])->first();

            if (!$user || !Hash::check($data['password'], $user['password'])) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            return $this->success('login successfully', new UserResource($user), $user->createToken('laravel_token')->plainTextToken);

        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();
            return $this->success('logout successfully');

        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return $this->success('register successfully', new UserResource($user));

        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

}
