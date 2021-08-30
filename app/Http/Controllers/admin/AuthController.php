<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'email'     => 'bail|required|email',
            'password'  => 'required|min:4',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::user()->userRole == 'user'){
                Auth::logout();
                return response()->json([
                    'message' => 'Authorization not available'
                ], 401);
            }else{
                return response()->json([
                    'msg' => 'You have successfully logined...'
                ], 200);
            }
        }else{
            return response()->json([
                'message' => 'User name or password incorrect'
            ], 401);
        }
    }
}
