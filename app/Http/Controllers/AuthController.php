<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt($credentials)) {
            // Generate a new token for the user
            $token = auth()->user()->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Generate a new token for the user
        //$token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'User created successfully'], 201);
    }
}
