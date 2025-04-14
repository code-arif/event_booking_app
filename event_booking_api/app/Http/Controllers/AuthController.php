<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //user registraion
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed',
            'phone' => 'required',
            'image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'error' => $validator->messages(),
                ],
                422,
            );
        }

        $image_url = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageNameToStore = uniqid() . '.' . $image->getClientOriginalExtension();
            $image_url = $image->storeAs('profile', $imageNameToStore, 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'role' => 'user',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'image' => $image_url,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(
            [
                'status' => true,
                'message' => 'User created successfully',
                'token' => $token,
                'data' => new UserResource($user),
            ],
            200,
        );
    }

    //user login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'error' => $validator->messages(),
                ],
                422,
            );
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Invalid email or password',
                ],
                401,
            );
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(
            [
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => $token,
                'data' => new UserResource($user),
            ],
            200,
        );
    }

    //user logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'status' => true,
                'message' => 'User logged out successfully',
            ],
            200,
        );
    }

    //get user
    public function user($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }
        return response()->json(
            [
                'status' => true,
                'message' => 'User retrieved successfully',
                'data' => new UserResource($user),
            ],
            200,
        );
    }
}
