<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_gol_venta extends Model
{
    use HasFactory;
    protected $table = 'detalle_gol_venta';
    protected $primaryKey = 'id_det_gol_venta';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fk_id_golosina;
    protected $fk_id_venta;
    protected $cantidad;
    protected $precioVenta;
    protected $importe;
    protected $fillable=["fk_id_golosina","fk_id_venta","cantidad","precioVenta","importe"];
    public $timestamps=false;
}
