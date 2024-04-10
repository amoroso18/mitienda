<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];

    // Relación con Producto (un registro de venta de producto pertenece a un producto)
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

}
