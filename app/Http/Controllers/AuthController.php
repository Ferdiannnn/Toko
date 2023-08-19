<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile()
    {
        $user = User::with('role')->get();
        return view('profile', ['user' => $user]);
    }

    public function changeProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        Session::flash('success');
        Session::flash('message', 'Profile changed');
        return redirect('/profile');
    }

    public function changepassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->oldpassword != Hash::check($request->oldpassword, $user->password)) {
            Session::flash('not successful');
            Session::flash('message', 'Old Password not match');
        } else {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            Session::flash('success');
            Session::flash('message', 'Password changed');
        }
        return redirect('/profile');
    }

    public function register()
    {
        return view('User.register');
    }

    public function store(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);
        UserCreated::dispatch($user);
        Session::flash('success');
        Session::flash('message', 'User created');
        return redirect('/');
    }
}