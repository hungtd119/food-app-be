<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return $this->responseJson('Unauthorized');
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password, [])) {
            throw new \Exception('Error in Login');
        }

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return $this->responseJson('Login success', [
            'accessToken' => $tokenResult,
            'user' => $user
        ]);
    }
    public function register(Request $request)
    {
        $checkUser = User::query()->where('email', $request->input('email'))->first();
        if ($checkUser) {
            throw new \Exception('User existed');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->responseJson('Register success', [
            'accessToken' => $user->createToken("authToken")->plainTextToken,
            'user' => $user
        ]);
    }
}
