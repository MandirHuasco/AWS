<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function CrearFactura(Request $data)
    {
        $data->validate(
            [
                'nro_fact'=>'required | min:1 | max:100',
                'nom_prov'=>'required | min:1 | max:100',
                'nom_em'=>'required | min:3 | max:100',
                'nom_cli'=>'required | min:1 | max:100',
            ]
        );

        $factura = new Factura();
        $factura->nro_fact = $data["nro_fact"];
        $factura->nom_prov = $data["nom_prov"];
        $factura->ent_sal_fact = $data["ent-sal-fact"];
        $factura->fact_Bol = $data["fact_Bol"];
        $factura->nom_em = $data["nom_em"];
        $factura->nom_cli = $data["nom_cli"];
        $factura->fecha_fac = $data["fecha"];
        $factura->estado = "Activo";
        $factura->fact_id_user = $data["fact_id_user"];
        $factura->save();

        return redirect()->route('facturas')->with('status', 'Factura create!');
    }
    public function Mostrar(){
        $id = session('id');
        $resultado = User::get();
        $resultadoFact = Factura::get();

        return view("factura", ["resultado"=>$resultado, "resultadoFact"=>$resultadoFact, "id"=>$id]);
    }
    public function desactivar(Request $tabla){
        $factura = Factura::find($tabla->id);
        $factura->estado = 'Inactivo';
        $factura->save();

        return redirect()->route('facturas')->with('status', 'Factura desactivate!');
    }
    public function activar(Request $tabla){
        $factura = Factura::find($tabla->id);
        $factura->estado = 'Activo';
        $factura->save();

        return redirect()->route('facturas')->with('status', 'Factura activate!');
    }
    public function editar(Request $data)
    {
        $factura = Factura::find($data->id);
        $factura->nro_fact = $data['nro_fact'];
        $factura->nom_prov = $data['nom_prov'];
        $factura->fact_Bol = $data['fact_Bol'];
        $factura->save();

        return redirect()->route('facturas');
    }
}
