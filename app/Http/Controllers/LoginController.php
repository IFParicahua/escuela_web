<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PersonaRoles;
use App\Personas;
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
        $nombre = Personas::where('id', Auth::user()->id_persona)->value('nombre');
        $apellidop = Personas::where('id', Auth::user()->id_persona)->value('apellidopat');
        $apellidom = Personas::where('id', Auth::user()->id_persona)->value('apellidomat');

        session()->put('session-user', $nombre . ' ' . $apellidop . ' ' . $apellidom);
        $roles = PersonaRoles::with('personaRol')->where('id_persona', 1)->get();
        return view('inicio', compact('roles'));
    }

    public function redirect($id)
    {
        switch ($id) {
            case '1':
                session()->put('sesion-rol', 'Administrador');
                return redirect('/Administrador');
                break;
            case '2':
                session()->put('sesion-rol', 'Contador');
                return redirect('/Contador');
                break;
            case '3':
                session()->put('sesion-rol', 'Regente');
                return redirect('/Regente');
                break;

            case '4':
                session()->put('sesion-rol', 'Profesor');
                return redirect('/Profesor');
                break;

            case '5':
                session()->put('sesion-rol', 'Padre');
                return redirect('/Padre');
                break;
        }
    }

}
