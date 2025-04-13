<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golosina extends Model
{
    use HasFactory;
    protected $table = 'golosina';
    protected $primaryKey = 'id_golosina';
    public $incrementing = true;
    protected $keyType = "int";
    protected $nombre;
    protected $precioVenta;
    protected $cantExistencia;
    protected $estado;
    protected $fillable=["nombre","precioVenta", "cantExistencia", "estado"];
    public $timestamps=false;
}