<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        try {
            $validate = Validator::make($request->only(['email', 'password']), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6|max:255',
            ])->validate();

            $user = User::where('email', '=', $validate['email'])->first();
            if (!Hash::check($validate['password'], $user->password)) {
                throw new Error('Invalid access data');
            }
            return response()->json(['token' => $user->createToken('api_authentication')->plainTextToken]);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
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

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
