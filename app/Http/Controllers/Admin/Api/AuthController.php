<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request, AuthRepository $authRepository)
    {
        return  $authRepository->createUserLoginToken($request);
    }


    public function logout(AuthRepository $authRepository)
    {
        return $authRepository->logout();
    }
}
