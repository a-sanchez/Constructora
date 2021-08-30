<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            return view("opciones");
        }
        return view("welcome");
    }

    public function inicioSesion(Request $request)
    {
        $credencial=$request->except("_token");
        if(Auth::attempt($credencial)){
            $request->session()->regenerate();
            return response()->json("Correcto",202);
        }
        return response()->json("Usuario o contraseña incorrectos",401);
    }

    public function salir()
    {
        Auth::logout();
        return redirect()->route("login");
    }

}
