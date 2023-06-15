<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {



        $admin = Auth::guard('admin')->user();
        // echo 'welcome'.$admin->name;


        // echo '<a href="'.route('admin.logout').'">Logout</a>';

        return view('admin.dashboard', compact('admin'));
    }





    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }



    public function changepassword()
    {
        $user = Auth::User();
        // dd($user);
        return view('admin.new-password', compact('user'));
    }

    public function new_password(Request $request, $id)
    {

        $request->validate([

            'password'=>'required|min:6|max:12',
            'confirm_password'=>'required|same:password'
        ]);

        $new_pass = User::find($id);
        $new_pass->password = Hash::make($request->password);
        $new_pass->save();
    }
}
