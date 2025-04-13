<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $incrementing = true;
    protected $keyType = "int";
    protected $fecha;
    protected $estado;
    protected $fillable=["fecha", "estado"];
    public $timestamps=false;
}