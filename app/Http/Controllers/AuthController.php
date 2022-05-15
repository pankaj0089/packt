<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $params = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:8'
        ]);

        if (!Auth::attempt($params)) {
            return $this->error('Incorrect login details!', 401);
        }
        $token = auth()->user()->createToken('auth_token')->plainTextToken;
        return response()->json([
           'access_token' => $token,
           'token_type' => 'Bearer',
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Tokens removed',
        ];
    }
}
