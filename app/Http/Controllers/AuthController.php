<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'group' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique(User::class)],
            'password' => ['required', 'string'],
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->group = $data['group'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return [
            'token' => $user->createToken('reg')->plainTextToken
        ];
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $data['email'])->first();
        if ($user === null) {
            return new JsonResponse([
                'message' => 'Login yoki parol xato',
            ], 400);
        }

        if (!Hash::check($data['password'], $user->password)) {
            return new JsonResponse([
                'message' => 'Login yoki parol xato',
            ], 400);
        }

        return [
            'token' => $user->createToken('reg')->plainTextToken
        ];
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()
            ->where('id', $user->currentAccessToken()->id)
            ->delete();

        return [
            'message' => 'Successfully logouted'
        ];
    }
}
