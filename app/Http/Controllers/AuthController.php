<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\Login;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Login $request)
    {
        $payload = $request->validated();

        if (Auth::attempt($payload)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => new UserResource($user),
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    public function me()
    {
        return new UserResource(Auth::user()->load(['unit', 'unit.bloodline']))->additional(['with_permissions' => true]);
    }
}
