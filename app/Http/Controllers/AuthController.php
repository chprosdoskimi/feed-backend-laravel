<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        # code...
    }
    public function signUp(Request $request)
    {
        try {
            $validate = Validator::make($request->only(['email', 'password', 'password_confirmation', 'name']), [
                'email'                 => 'required|email|unique:users,email',
                'name'                  => 'required|min:3|max:255',
                'password'              => 'required|min:6|max:255|confirmed',
                'password_confirmation' => 'required|min:6|max:255',
            ])->validate();

            $user = User::create(array_merge($validate, ['password' => Hash::make($validate['password'])]));

            return response()->json($user);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
