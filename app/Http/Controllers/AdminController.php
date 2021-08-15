<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(){
        if( Auth()->user()->role == 1) {
            return view('admin.dashboard.index');
        }
        else{
            return redirect()->route('logout');
        }
    }

    public function userList(){
        $users = User::all();
        return view('admin.userList',compact('users'));
    }

    public function activateUser($id){
        $user = User::where('id',$id)->first();
        $user->status = "1";
        $user->save();
        return redirect()->route('userlist');
    }

    public function inactivateUser($id){
        $user = User::where('id',$id)->first();
        $user->status = "0";
        $user->save();
        return redirect()->route('userlist');
    }
}
