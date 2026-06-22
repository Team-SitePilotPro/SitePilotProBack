<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    // Authenticate the user and return a Sanctum token.
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(
                ['message' => 'Invalid credentials.'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user  = Auth::user();
        // Assign the user's role as a token ability for route-level authorization.
        $token = $user->createToken('api-token', [$user->userRole->value])->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => UserResource::make($user),
        ]);
    }

    // Revoke the current user's access token.
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    // Return the currently authenticated user's profile.
    public function me(Request $request): JsonResponse
    {
        return UserResource::make($request->user())->response();
    }
}
