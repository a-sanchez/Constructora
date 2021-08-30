<?php

namespace App\Http\Controllers;
use App\Models\configuracion;
use App\Models\permisos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\pantallas;

class ConfiguracionController extends Controller
{
    public function index(){
        $pantallas= pantallas::all();
        $users=configuracion::where("id","!=","1")->get();
        return view('configuracion.permisos_configuracion',compact("users","pantallas"));


    }
    public function create(){
        return view('configuracion.add_usuario');
    }

    public function listado(){
        $usuario = Auth::user();
        $users=configuracion::all();
        $permisos=permisos::where("id_usuario",$usuario->id);
        return view('configuracion.listado',compact('users'));
    }
    public function store(Request $request){
        $validation=$request->all();
        $validation["password"] = Hash::make($validation["password"]);
        $user=configuracion::create($validation);
        return response()->json("Usuario creado con exito",201);
    }

    public function show($id){
        //
    }

    public function edit($id){
        $user=configuracion::find($id);
        return view("configuracion.editar_user",compact("user"));
    }

    public function update(Request $request,$id){
        $user=configuracion::find($id);
        $update=$user->update($request->all());
        return $update;
    }

    public function destroy($id){
        $user=configuracion::find($id);
        configuracion::destroy($id);
        return $user;
    }
}
