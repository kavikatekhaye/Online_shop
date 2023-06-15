<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    // protected function authenticate($request, array $guards)
    // {
    //     if ($this->auth->guard($admin)->check()) {
    //     return $this->auth->shouldUse($admin);
    // }

    //     $this->unauthenticated($request, ['admin']);
    // }

    public function authenticate(Request $request)
    {

        $validator = validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);



        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                // return redirect()->route('admin.dashboard');

                $admin = Auth::guard('admin')->user();

                if ($admin->role ==2) {
                    return redirect()->route('admin.dashboard')->with('sussess', 'Welcome');
                } else {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'You are not authorized to access admin panel');
                }
            }
        } else {
            return redirect()->route('admin.login')->withErrors($validator)->withInput($request->only('email'));
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login')->with('error', 'You are not authorized to access admin panel');
    }
}
