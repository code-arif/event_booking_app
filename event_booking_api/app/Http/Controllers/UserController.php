<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //get all user
    public function getAllUser()
    {
        $user = User::get();
        return response()->json([
            'message' => 'success',
            'data' => $user,
        ]);
    }

    //get user by id
    public function getUserById($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'data' => null,
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $user,
        ]);
    }

    //create user
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'phone' => 'required',
        ]);

        $user = User::create($request->all());
        return response()->json(
            [
                'message' => 'create success',
                'data' => $user,
            ],
            201,
        );
    }

    //update user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'role' => 'required',
            'phone' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json([
            'message' => 'success',
            'data' => $user,
        ]);
    }

    //delete user
    public function deleteUser($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        $user->delete();
        return response()->json(['message' => 'Delete success']);
    }
    
}
