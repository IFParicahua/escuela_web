<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PersonaRoles;
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
        $roles = PersonaRoles::with('personaRol')->where('id_persona', 1)->get();
        return view('inicio', compact('roles'));
    }

    public function redirect($id)
    {
        switch ($id) {
            case '1':
                return redirect('/Administrador');
                break;
            case '2':
                return redirect('/Contador');
                break;
            case '3':
                return redirect('/Regente');
                break;

            case '4':
                return redirect('/Profesor');
                break;

            case '5':
                return redirect('/Padre');
                break;
        }
    }

}
