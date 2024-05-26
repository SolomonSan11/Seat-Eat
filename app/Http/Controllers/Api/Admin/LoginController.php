<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = $this->validateLoginData($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');
        $users = User::where('email', $credentials['email'])->first();

        if ($users && Hash::check($credentials['password'], $users->password)) {
            $token = $users->createToken('Token Name')->plainTextToken;
            $messages = ['status' => 200, 'token' => $token, 'users' => $users, 'message' => 'Login Success'];
            return response()->json($messages);
        } else {
            return response()->json(['message' => 'Your credential is does not match'], 401);
        }
    }

    protected function validateLoginData(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
                    ->symbols(),
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
