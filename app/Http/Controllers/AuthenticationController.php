<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    //Login Function
    public function login(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::guard('user')->user();
            $token = $user->createToken('auth')->plainTextToken;

            return success($token, null);
        }

        return error('some thing went wrong', 'username or password is incorrect', 502);
    }

    //Get Profile Information Function
    public function profile()
    {
        return success(Auth::guard('user')->user(), null);
    }

    //Logout Function
    public function logout()
    {
        Auth::guard('user')->user()->tokens()->delete();

        return success(null, 'logout successfully');
    }

    //Edit Profile Function
    public function editProfile(ProfileRequest $profileRequest)
    {
        Auth::guard('user')->user()->update([
            'username' => $profileRequest->username,
            'email' => $profileRequest->email,
            'phone_number' => $profileRequest->phone_number,
            'address' => $profileRequest->address,
        ]);

        return success(null, 'your profile updated successfully');
    }

    //Edit Password Function
    public function editPassword(PasswordRequest $passwordRequest)
    {
        $user = Auth::guard('user')->user();

        if (Hash::check($passwordRequest->password, $user->password)) {
            if ($passwordRequest->new_password === $passwordRequest->confirm_password) {
                $user->update([
                    'password' => Hash::make($passwordRequest->new_password),
                ]);

                return success(null,'your password updated successfully');
            }

            return error('some thing went wrong', 'incorrect password confirmation', 502);
        }
        return error('some thing went wrong', 'incorrect password', 502);
    }
}