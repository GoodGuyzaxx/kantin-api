<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('pages.login');
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:users',
           'password' => 'required|confirmed'
        ]);

        $validateData['password'] = Hash::make($request->password);

        $user = User::create($validateData);

        $accessToken = $user -> createToken('authToken')->accessToken;

//        return response(['user' => $user, 'access_token' => $accessToken], 201);
        return response()->json([
            'user' => $user,
            'access_token' => $accessToken,
        ], 201);
    }

//    public function login(Request $request)
//    {
//        $loginData = $request->validate([
//            'email' => 'required|email',
//            'password' => 'required'
//        ]);
//
//        if (!Auth::attempt($loginData)) {
//            if ($request->expectsJson()) {
//                return response()->json([
//                    'success' => false,
//                    'message' => "Email atau Password Salah"
//                ], 400);
//            }
//            return back()->withErrors([
//                'email' => 'The provided credentials do not match our records.',
//            ])->onlyInput('email');
//        }
//
//        $user = Auth::user();
//        $accessToken = $user->createToken('authToken')->accessToken;
//
//        if ($request->expectsJson()) {
//            return response()->json([
//                'success' => true,
//                'message' => "sukses login",
//                'user' => [
//                    'name' => $user->name,
//                    'email' => $user->email,
//                    'access_token' => $accessToken,
//                ],
//            ], 201);
//        }
//
//        // For web requests
//        $request->session()->regenerate();
//        $request->session()->put('access_token', $accessToken);
//        return redirect()->intended('dashboard')->with('status', 'You have been logged in successfully.');
//    }

//
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)){
            return response([
                'success' => false,
                'message' => "Email atau Password Salah"
            ], 400);
        }

        $accessToken = auth()-> user() -> createToken('authToken')->accessToken;

//        return response(['user'=> auth()->user(),'access_token'=> $accessToken]);
        return response()->json([
            'success' => true,
            'message' => "sukses login",
            'user' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'access_token' => $accessToken,
            ],
        ],201);
    }

}
