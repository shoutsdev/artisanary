<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user)
            {
                return response()->json([
                    'error' => 'User not found'
                ], 422);
            }

            $credentials = $request->only('email', 'password');

            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json([
                        'error' => 'Invalid Credentials',
                    ], 422);
                }
            } catch (JWTException $e) {
                return response()->json([
                    'error' => 'Could not create token'
                ], 422);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 422);
            }

            Auth::attempt($credentials);

            return response()->json([
                'token' => $token,
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }
}
