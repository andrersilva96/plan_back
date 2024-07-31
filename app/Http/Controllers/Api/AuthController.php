<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\{Hash, Validator};

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()->getMessages()
            ], 409);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json(['token' => JWTAuth::fromUser($user)], 201);
    }

    public function login(Request $request): JsonResponse
    {
        if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => __('auth.failed')], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function logout(): JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => __('auth.logout')]);
        } catch (JWTException) {
            return response()->json(['message' => __('auth.failed_logout')]);
        }
    }

    public function me(): JsonResponse
    {
        return response()->json(['data' => auth()->user()]);
    }
}
