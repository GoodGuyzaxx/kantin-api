<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function authenticate(LoginRequest $request)
    {
//        $request = $request->validate([
//            'email' => 'required|email',
//            'password' => 'required'
//        ]);
//
//        $data = [
//            'email' => $request['email'],
//            'password' => $request['password'],
//        ];
//
//        if (Auth::attempt($data)) {
//            return redirect()->route('dashboard');
//        } else {
//            return redirect()->route('login.index')->withErrors(['email' => 'Email atau password salah!']);
//        }

        $credentials = $request->getCredentials();

        // if failed
        if (!Auth::validate($credentials)) :
            return back()->with('failed', "Login failed, please try again");
        endif;

        // autentikasi user
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user, $request->get('remember'));
        return $this->authenticated($request, $user);
    }

    protected function authenticated()
    {
        return redirect()->intended('/dashboard')->with('status', 'You are now logged in');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out!');
    }
}
