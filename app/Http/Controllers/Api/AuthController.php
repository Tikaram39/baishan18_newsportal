<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => [
                'required',
                'string',
                Password::min(6)
                    ->letters()
                    ->numbers()
                    ->symbols()
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = $user->createToken($user->id)->plainTextToken;

        return response()->json([
            'success' => true,
            "token" => $token,
            'message' => 'User registered successfully'
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.'
            ], 400);
        }

        $token = $user->createToken($user->id)->plainTextToken;
        $ip = $request->ip();

        // Save session data
        DB::table('sessions')->insert([
            'id' => uniqid(),
            'user_id' => $user->id,
            'ip_address' => $ip,
            'token' => $token,
            'payload' => $request,
            "last_activity" => time(),
            'created_at' => now()
        ]);

        // Verify IP and token (example check)
        $session = DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('ip_address', $ip)
            ->where('token', $token)
            ->first();

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Session validation failed.'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'message' => 'User logged in successfully'
        ]);
    }
}
