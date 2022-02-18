<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Factura;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Salida;
use App\Models\User;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function Mostrar(){
        $resultado = User::get();
        $resultadoPro = Producto::get();
        $resultadoFact = Factura::get();
        $resultadoEntr = Entrada::get();
        $resultadoSal = Salida::get();
        $resultadoInv = Inventario::get();
        return view("inventario", ["resultado"=>$resultado, "resultadoPro"=>$resultadoPro, "resultadoFact"=>$resultadoFact, "resultadoEntr"=>$resultadoEntr, "resultadoSal"=>$resultadoSal, "resultadoInv"=>$resultadoInv]);
    }
    public function desactivar(Request $tabla){
        $inventario = Inventario::find($tabla->id);
        $inventario->estado = 'Inactivo';
        $inventario->save();
        return redirect()->route('inventario')->with('status', 'Producto desactivate!');
    }
    public function activar(Request $tabla){
        $inventario = Inventario::find($tabla->id);
        $inventario->estado = 'Activo';
        $inventario->save();
        return redirect()->route('inventario')->with('status', 'Producto activate!');
    }
}
