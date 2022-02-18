<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\User;
use App\Models\Inventario;

class ProductoController extends Controller
{
    public function CrearProducto(Request $data)
    {
        $data->validate(
            [
                'producto'=>'required | min:3 | max:1000',
                'desc'=>'required | min:3 | max:45',
                'img' =>'mimes:jpeg,bmp,png,jpg | max:2048',
            ]
        );

        if($data["img"]==""){
            $producto = new Producto();
            $producto->nom_pro = $data["producto"];
            $producto->desc_pro = $data["desc"];
            $producto->img_pro = $data["img"];
            $producto->estado = "Activo";
            $producto->pro_id_user = $data["pro_id_user"];
            $producto->save();

            $resultadoPro = Producto::get();

            foreach ($resultadoPro as $producto){
                $var = -1;

                if($var<$producto['id']){
                    $var = $producto['id'];
                }
            }

            $inventario = new Inventario();
            $inventario->prod_inv = $data["producto"];
            $inventario->entrada_inv = 0;
            $inventario->salida_inv = 0;
            $inventario->stock_inv = 0;
            $inventario->precio_inv = 0;
            $inventario->importe_inv = 0;
            $inventario->estado = "Activo";
            $inventario->inv_id_user = $data["pro_id_user"];
            $inventario->inv_id_productos = $var;
            $inventario->save();

            return redirect()->route('productos')->with('status', 'Product create!');
        }else{
            $file = $data["img"];
            $nombre =  time()."_".$file->getClientOriginalName();
            \Storage::disk('public')->put($nombre,  \File::get($file));

            $producto = new Producto();
            $producto->nom_pro = $data["producto"];
            $producto->desc_pro = $data["desc"];
            $producto->img_pro = $nombre;
            $producto->estado = "Activo";
            $producto->pro_id_user = $data["pro_id_user"];
            $producto->save();

            $resultadoPro = Producto::get();

            foreach ($resultadoPro as $producto){
                $var = -1;

                if($var<$producto['id']){
                    $var = $producto['id'];
                }
            }

            $inventario = new Inventario();
            $inventario->prod_inv = $data["producto"];
            $inventario->entrada_inv = 0;
            $inventario->salida_inv = 0;
            $inventario->stock_inv = 0;
            $inventario->precio_inv = 0;
            $inventario->importe_inv = 0;
            $inventario->estado = "Activo";
            $inventario->inv_id_user = $data["pro_id_user"];
            $inventario->inv_id_productos = $var;
            $inventario->save();

            return redirect()->route('productos')->with('status', 'Product create!');
        }
    }
    public function Mostrar(){
        $resultado = User::get();
        $resultadoPro = Producto::get();
        return view("producto", ["resultado"=>$resultado, "resultadoPro"=>$resultadoPro]);
    }
    public function desactivar(Request $tabla){
        $producto = Producto::find($tabla->id);
        $producto->estado = 'Inactivo';
        $producto->save();

        $inventario = Inventario::find($tabla->id);
        $inventario->estado = 'Inactivo';
        $inventario->save();

        return redirect()->route('productos')->with('status', 'Product desactivate!');
    }
    public function activar(Request $tabla){
        $producto = Producto::find($tabla->id);
        $producto->estado = 'Activo';
        $producto->save();

        $inventario = Inventario::find($tabla->id);
        $inventario->estado = 'Activo';
        $inventario->save();

        return redirect()->route('productos')->with('status', 'Product activate!');
    }
}
