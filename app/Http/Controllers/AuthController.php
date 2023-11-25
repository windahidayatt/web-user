<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages/auth/index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::with('role')->where('username', $credentials['username'])->first();

        if($user != null){

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                if($user->role->name == 'Admin'){
                    return redirect()->intended('/user');
                }else if($user->role->name == 'Participant'){
                    return redirect()->intended('/team-user');
                }
            }
        }

        Alert::error('Gagal!', 'Username / password salah.');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/login');
    }
}
