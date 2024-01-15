<?php

namespace App\Http\Controllers\Admin\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function user(){

        return response()->json(User::all());
    }
}
