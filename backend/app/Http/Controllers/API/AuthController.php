<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Login gagal',
                'data' => null
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => ['token' => $token]
        ]);
    }
}
