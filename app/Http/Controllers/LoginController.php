<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PersonaRole;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        $credentials = $this->validate(request(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credentials)) {
            return redirect('/inicio');
        } else {
            return back()->withErrors(['username' => trans('auth.failed')])->withInput(request(['username']));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function inicio()
    {
        $personaroles = PersonaRole::all()->roles;
        return view('inicio', compact('personaroles'));
    }
}
