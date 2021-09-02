<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() && $request->path() != 'login'){
            return redirect('/login');
        }


        if (Auth::check() && Auth::user()->userRole == 'admin'){
            if ($request->path() == 'login'){
                return redirect('/');
            }
        }
        return view('welcome');
    }
}
