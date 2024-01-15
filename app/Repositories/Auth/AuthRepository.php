<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AuthRepository
{
    public function createUserLoginToken(Request $request)
    {
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     $user = Auth::user();
        //     $success['token'] =  $user->createToken('MyApp')->accessToken;
        //     $success['name'] =  $user->name;

        //     return response()->json([$success, 'User login successfully.']);
        // } else {
        //     return response()->json('Unauthorised.', ['error' => 'Unauthorised']);
        // }

        if (!Auth::attempt($request->only('email', 'password'))) {

            return response([
                'error' => 'Invaled Credentials !',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->accessToken;
        $cookie = cookie('token', $token, 60 * 24);

        return \response([
            'token' => $token,
        ])->withCookie($cookie);
    }

    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged out successfully']);
    }
}
