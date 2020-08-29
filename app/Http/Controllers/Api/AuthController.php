<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegiserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $data = $request->validated();
        $user = User::query()->where('email', $data['email'])->first();
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'error' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken($request->userAgent())->plainTextToken;
        return response()->json(['token' => $token],201);
    }

    public function register(AuthRegiserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::query()->create($data);
        if ($user) {
            $token = $user->createToken($request->userAgent())->plainTextToken;
            return response()->json(['token' => $token],201);
        }
        abort(500);
    }

    public function logout(Request $request)
    {
        $status = $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => $status]);
    }
}
