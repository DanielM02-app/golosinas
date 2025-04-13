<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;
//use App\Http\Controllers\GolosinaController;
//use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('home',["breadcrumbs"=>[]]);
});
    
Route::get ("/catalogos/golosinas",[CatalogosController::class, "golosinasGet"]);
Route::get ("/catalogos/ventas",[CatalogosController::class, "ventasGet"]);
Route::get ("/catalogos/detalles",[CatalogosController::class, "detalleGet"]);
Route::get("/ventas/agregar",[CatalogosController::class, "ventasAgregarGet"]);
Route::post("/ventas/agregar", [CatalogosController::class, "ventasAgregarPost"]);