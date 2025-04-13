<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Golosina;
use App\Models\Venta;
use App\Models\Detalle_gol_venta;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CatalogosController extends Controller
{
    public function home():View
    {
        return view('home',["breadcrumbs"=>[]]);
    }

    public function golosinasGet(): View
    {
        $golosinas = Golosina::all();
        return view('catalogos/golosinasGet', [
            'golosinas' => $golosinas,
            "breadcrumbs"=>[
                "Inicio"=>url("/"),
                "Golosinas"=>url("/catalogos/golosinas")
            ]
        ]);
    }

    public function ventasGet(): View
    {
        $ventas = Venta::all();
        return view('catalogos/ventasGet', [
            'ventas' => $ventas,
            "breadcrumbs"=>[
                "Inicio"=>url("/"),
                "Ventas"=>url("/catalogos/ventas")
            ]
        ]);
    }

    public function detalleGet(): View
    {
        $detalles = Detalle_gol_venta::all();
        return view('catalogos/detalleGet', [
            'detalles' => $detalles,
            "breadcrumbs"=>[
                "Inicio"=>url("/"),
                "Detalles"=>url("/catalogos/detalles")
            ]
        ]);
    }

    public function ventasAgregarGet(): View
    {
        // Se obtienen las golosinas para desplegar en la lista de productos
        $golosinas = Golosina::all();
        return view('catalogos.ventasAgregarGet', [
            "golosinas"   => $golosinas,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Ventas" => url("/catalogos/ventas"),
                "Agregar" => url("/catalogos/ventas/agregar")
            ]
        ]);
    }

    public function ventasAgregarPost(Request $request)
    {
        $request->validate([
            "fecha"  => "required|date",
            "estado" => "required|in:0,1",
            // Puedes validar los detalles si es necesario.
        ]);
    
        // Crear la venta (cabecera)
        $venta = new Venta([
            "fecha"  => $request->input("fecha"),
            "estado" => $request->input("estado"),
        ]);
        $venta->save();
    
        // Insertar cada detalle registrado en el formulario
        $detalles = $request->input("detalles");
        if(is_array($detalles)){
            foreach($detalles as $detalleData){
                $detalle = new Detalle_gol_venta([
                    "fk_id_golosina" => $detalleData['producto'],
                    "fk_id_venta"    => $venta->id_venta,
                    "cantidad"       => $detalleData['cantidad'],
                    "precioVenta"    => $detalleData['precio'],
                    "importe"        => $detalleData['importe']
                ]);
                $detalle->save();
            }
        }

    
        return redirect("/catalogos/ventas");
    }
    

}
