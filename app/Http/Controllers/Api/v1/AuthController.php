<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $role = Role::where('name','user')->first();

        $user = User::create( [
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => $role->id
        ]);

        $token = JWTAuth::fromUser($user);
        $user->load('role', 'profile');
        return response()->json([
            'success' => true,
            'message' => 'Registration successful. Please check your email for the OTP.',
            'token'   => $token,
            'user'    => new UserResource($user)
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->load('role', 'profile');
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => new UserResource($user)
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ], 200);
    }
}