<?php

namespace App\Http\Controllers;
use App\Models\configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index(){
        $users=configuracion::all();
        return view('configuracion.permisos_configuracion',compact("users") );
        
    }
    public function create(){
        return view('configuracion.add_usuario');
    }

    public function listado(){
        $users=configuracion::all();
        return view('configuracion.listado',compact('users'));
    }
    public function store(Request $request){
        $validation=$request->all();
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