<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserConttoller extends Controller
{
    public function uploadUserImage(Request $requeste){
        if ($requeste->file){
            $fileName = time().random_int(0,999).'.'.$requeste->file->getClientOriginalExtension();
            $requeste->file->storeAs('public/users/', $fileName);
            return  'storage/users/'.$fileName;
        }return false;
    }

    public function deleteUserImage(Request $request){
        @unlink($request->image);
    }

    public function addUser(Request $request){
        $this->validate($request,[
            'userName'  => 'required|max:30',
            'email'     => 'required|unique:users',
            'password'  => 'required|min:4',
            'iconImage' => 'required|',
            'userRole'  => 'required',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        User::create($data);
    }

    public function index(){
        return response()->json(User::all());
    }

    public function deleteUser(Request $request){
        $user = User::findOrFail($request->id);
        @unlink($user->iconImage);
        $user->delete();
    }


}
