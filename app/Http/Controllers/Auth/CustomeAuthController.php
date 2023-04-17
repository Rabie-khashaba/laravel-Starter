<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomeAuthController extends Controller
{
    //

    public function adults(){
        return view('customAuth.index');
    }

    public function site(){
        return view('site');
    }


    public function admin(){
        return view('admin');
    }


    public function AdminLogin(){
        return view('auth.AdminLogin');
    }

    public function checkAdminLogin(Request $request){

        //validate
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
        ]);
        //check if exist
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/admin');  // ('/admin') ==> route contain Html of Admin page
        }
        return back()->withInput($request->only('email'));
    }

}
