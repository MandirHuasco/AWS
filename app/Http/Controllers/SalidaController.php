<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Factura;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Salida;
use App\Models\User;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    public function CrearSalida(Request $data)
    {
        $data->validate(
            [
                'producto'=>'required | min:1 | max:100',
                'cantidad'=>'required | min:1 | max:100',
                'margen_ganancia'=>'required | min:1 | max:100',
                'factura'=>'required | min:1 | max:100',
            ]
        );

        $resultadoEntr = Entrada::get();

        foreach ($resultadoEntr as $entrada){
            if($entrada['prod_entr'] == $data["producto"]){
                $pre_sal = $entrada['costo_adqu_unid_entr'];
            }
        }

        $total_sal = $data["cantidad"] * $pre_sal;

        if($data["margen_ganancia"] == 0){
            $margen_ganancia_unit_sal = $pre_sal;
        }else{
            $margen_ganancia_unit_sal = $pre_sal * $data["margen_ganancia"]/100;
        }

        if($data["margen_ganancia"] == 0){
            $margen_ganancia_total_sal = $total_sal;
        }else{
            $margen_ganancia_total_sal = $total_sal * $data["margen_ganancia"]/100;
        }

        $valor_unid_sal = $margen_ganancia_unit_sal + $pre_sal;
        $valor_total_sal = $margen_ganancia_total_sal + $total_sal;

        if($data["igv"] == 1){
            $IGV_unit_sal = 0;
        }else{
            $IGV_unit_sal = $valor_unid_sal * $data["igv"]/100;
        }

        if($data["igv"] == 1){
            $IGV_total_sal = 0;
        }else{
            $IGV_total_sal = $valor_total_sal * $data["igv"]/100;
        }
        $precio_publico_unid_sal = $valor_unid_sal + $IGV_unit_sal;
        $precio_publico_total_sal = $valor_total_sal + $IGV_total_sal;

        $resultadoPro = Producto::get();

        foreach ($resultadoPro as $producto){

            if($producto['id'] == $data['producto']){
                $resultadoInv = Inventario::get();

                foreach ($resultadoInv as $inventario){
                    if($inventario['inv_id_productos'] == $data['producto']){
                        $suma = $inventario['salida_inv'] + $data['cantidad'];
                        $stock = $inventario['entrada_inv'] - $suma;
                        $importe = $stock * $precio_publico_unid_sal;
                    }
                }

                if($stock < 0){
                    return redirect()->route('salidas')->with('status', 'Stock menor a cero');
                }else{

                    $salida = new Salida();
                    $salida->prod_sal = $data["producto"];
                    $salida->cant_sal = $data["cantidad"];
                    $salida->pre_sal = $pre_sal;
                    $salida->total_sal = $total_sal;
                    $salida->margen_ganancia_porcentaje_sal = $data["margen_ganancia"];
                    $salida->margen_ganancia_unit_sal = $margen_ganancia_unit_sal;
                    $salida->margen_ganancia_total_sal = $margen_ganancia_total_sal;
                    $salida->valor_unid_sal = $valor_unid_sal;
                    $salida->valor_total_sal = $valor_total_sal;
                    $salida->IGV_unit_sal = $IGV_unit_sal;
                    $salida->IGV_total_sal = $IGV_total_sal;
                    $salida->precio_publico_unid_sal = $precio_publico_unid_sal;
                    $salida->precio_publico_total_sal = $precio_publico_total_sal;
                    $salida->estado = "Activo";
                    $salida->sal_id_user = $data["sal_id_user"];
                    $salida->fact_id_salidas = $data["factura"];
                    $salida->save();

                    $inventario = Inventario::find($producto['id']);
                    $inventario->salida_inv = $suma;
                    $inventario->precio_inv = $precio_publico_unid_sal;
                    $inventario->stock_inv = $stock;
                    $inventario->importe_inv = $importe;
                    $inventario->save();
                }
            }
        }

        return redirect()->route('salidas')->with('status', 'Salida create!');
    }
    public function Mostrar(){
        $resultado = User::get();
        $resultadoPro = Producto::get();
        $resultadoFact = Factura::get();
        $resultadoEntr = Entrada::get();
        $resultadoSal = Salida::get();
        return view("salidas", ["resultado"=>$resultado, "resultadoPro"=>$resultadoPro, "resultadoFact"=>$resultadoFact, "resultadoEntr"=>$resultadoEntr, "resultadoSal"=>$resultadoSal]);
    }
    public function desactivar(Request $tabla){
        $salida = Salida::find($tabla->id);
        $salida->estado = 'Inactivo';
        $salida->save();
        return redirect()->route('salidas')->with('status', 'Salida desactivate!');
    }
    public function activar(Request $tabla){
        $salida = Salida::find($tabla->id);
        $salida->estado = 'Activo';
        $salida->save();
        return redirect()->route('salidas')->with('status', 'Salida activate!');
    }
}
