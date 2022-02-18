<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class UserController
{
    public function mostrar(){
        $id = Auth::id();
        $user=User::where("id", $id)->get();
        return view("perfil", ["user"=>$user]);
    }
    public function actualizar(Request $data){
        $user = User::find(Auth::id());
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->ciudad = $data['ciudad'];
        $user->codigo = $data['codigo'];
        $user->save();
        return redirect("/perfil")->with('status', 'Profile updated!');
    }
    public function desactivar(Request $tabla){
        $user = User::find($tabla->id);
        $user->estado = 'Inactivo';
        $user->save();

        return redirect("/home")->with('status', 'User Inactive!');
    }
    public function activar(Request $tabla){
        $user = User::find($tabla->id);
        $user->estado = 'Activo';
        $user->save();

        return redirect("/home")->with('status', 'User Activate!');
    }
}
