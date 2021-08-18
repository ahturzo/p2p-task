<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'       => ['required', 'email'],
            'password'    => ['required', 'string'],
        ]);

        if($data) {
            $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return $this->respondWithToken($token);
        }
    }

    public function me()
    {
        $user= JWTAuth::user();
        return response()->json($this->guard()->user());
    }

    public function allusers()
    {
        return User::all();
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
