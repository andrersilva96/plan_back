<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\{Hash, Validator};

/**
 * @OA\Info(title="Authentication", version="0.1")
 */
class AuthController extends Controller
{
    /**
     * ! I don't like to use swagger because makes the code a lot of comments, so I prefer to use the Postman
     * ! Follow the documentation: https://documenter.getpostman.com/view/10880762/2sA3kd9cua
     * ! this is an swagger example.
     */
    /**
     * @OA\Get(
     *      path="/api/register",
     *      tags={"Register"},
     *      description="Returns the token",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={"name":"André Rodrigues","email":"andre.rsilva96@gmail.com","password":"123456789","password_confirmation":"123456789"}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success": true, "token": "token generated"}, summary="An result object."),
     *         )
     *       ),
     *      @OA\Response(
     *          response=409,
     *          description="Conflict"
     *      )
     * )
     */
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
