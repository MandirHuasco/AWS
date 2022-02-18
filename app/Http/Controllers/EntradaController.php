<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Factura;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function CrearEntrada(Request $data)
    {
        $data->validate(
            [
                'producto'=>'required | min:1 | max:100',
                'cantidad'=>'required | min:1 | max:100',
                'precio'=>'required | min:1 | max:100',
                'desc_entr'=>'required | min:1 | max:100',
                'flete_unidad'=>'required | min:1 | max:100',
                'recargo_porcentaje_entr'=>'required | min:1 | max:100',
                'factura'=>'required | min:1 | max:100',
            ]
        );

        $total_entr = $data["cantidad"] * $data["precio"];
        $importe_desc_entr = $total_entr * $data["desc_entr"]/100;
        $valor_compra_neto_entr = $total_entr - $importe_desc_entr;
        $flete_total_entr = $data["cantidad"] * $data["flete_unidad"];
        $total_recargo_entr = $valor_compra_neto_entr * $data["recargo_porcentaje_entr"]/100;
        $costo_adqu_total_entr = $valor_compra_neto_entr + $flete_total_entr + $total_recargo_entr;
        $costo_adqu_unid_entr = $costo_adqu_total_entr/$data["cantidad"];

        $entrada = new Entrada();
        $entrada->prod_entr = $data["producto"];
        $entrada->cant_entr = $data["cantidad"];
        $entrada->pre_entr = $data["precio"];
        $entrada->total_entr = $total_entr;
        $entrada->desc_entr = $data["desc_entr"];
        $entrada->importe_desc_entr = $importe_desc_entr;
        $entrada->valor_compra_neto_entr = $valor_compra_neto_entr;
        $entrada->flete_unidad_entr = $data["flete_unidad"];
        $entrada->flete_total_entr = $flete_total_entr;
        $entrada->recargo_porcentaje_entr = $data["recargo_porcentaje_entr"];
        $entrada->total_recargo_entr = $total_recargo_entr;
        $entrada->costo_adqu_unid_entr = $costo_adqu_unid_entr;
        $entrada->costo_adqu_total_entr = $costo_adqu_total_entr;
        $entrada->estado = "Activo";
        $entrada->entr_id_user = $data["entr_id_user"];
        $entrada->fact_id_entradas = $data["factura"];
        $entrada->save();

        $resultadoPro = Producto::get();

        foreach ($resultadoPro as $producto){

            if($producto['id'] == $data['producto']){
                $resultadoInv = Inventario::get();

                foreach ($resultadoInv as $inventario){
                    if($inventario['inv_id_productos'] == $data['producto']){
                        $suma = $inventario['entrada_inv'] + $data['cantidad'];

                        $stock = $suma - $inventario['salida_inv'];
                    }
                }

                $inventario = Inventario::find($producto['id']);
                $inventario->entrada_inv = $suma;
                $inventario->precio_inv = 0;
                $inventario->stock_inv = $stock;
                $inventario->importe_inv = 0;
                $inventario->save();
            }
        }

        return redirect()->route('entradas')->with('status', 'Entrada create!');
    }
    public function Mostrar(){
        $resultado = User::get();
        $resultadoPro = Producto::get();
        $resultadoFact = Factura::get();
        $resultadoEntr = Entrada::get();
        return view("entradas", ["resultado"=>$resultado, "resultadoPro"=>$resultadoPro, "resultadoFact"=>$resultadoFact, "resultadoEntr"=>$resultadoEntr]);
    }
    public function desactivar(Request $tabla){
        $entrada = Entrada::find($tabla->id);
        $entrada->estado = 'Inactivo';
        $entrada->save();

        $resultadoInv = Inventario::get();
        $resultadoEntr = Entrada::get();

        foreach ($resultadoEntr as $entrada){
            if($entrada['id'] == $tabla['id']){
                foreach ($resultadoInv as $inventario){
                    if($inventario['inv_id_productos'] == $entrada['prod_entr']){
                        $id_inventario = $inventario['inv_id_productos'];
                        $suma = $inventario['entrada_inv'] - $entrada['cant_entr'];
                    }
                }
            }
        }

        $inventario = Inventario::find($id_inventario);
        $inventario->entrada_inv = $suma;
        /*$inventario->stock_inv = $suma; NECESITO SALIDA*/
        $inventario->save();

        return redirect()->route('entradas')->with('status', 'Entrada desactivate!');
    }
    public function activar(Request $tabla){
        $entrada = Entrada::find($tabla->id);
        $entrada->estado = 'Activo';
        $entrada->save();

        $resultadoInv = Inventario::get();
        $resultadoEntr = Entrada::get();

        foreach ($resultadoEntr as $entrada){
            if($entrada['id'] == $tabla['id']){
                foreach ($resultadoInv as $inventario){
                    if($inventario['inv_id_productos'] == $entrada['prod_entr']){
                        $id_inventario = $inventario['inv_id_productos'];
                        $suma = $inventario['entrada_inv'] + $entrada['cant_entr'];
                    }
                }
            }
        }

        $inventario = Inventario::find($id_inventario);
        $inventario->entrada_inv = $suma;
        /*$inventario->stock_inv = $suma; NECESITO SALIDA*/
        $inventario->save();

        return redirect()->route('entradas')->with('status', 'Entrada activate!');
    }
}
