<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
       'cliente_id',
        'usuario_id',
        'tipo_estado_venta_id',
        'subtotal', 
        'igv', 
        'total', 
        'descuento', 
    ];

    // Relación con Cliente (una venta pertenece a un cliente)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con Usuario (una venta pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con TipoEstadoVenta (una venta tiene un tipo de estado de venta)
    public function tipoEstadoVenta()
    {
        return $this->belongsTo(TipoEstadoVenta::class);
    }

    
    public function productos()
    {
        return $this->hasMany(VentaProducto::class, 'venta_id', 'id');
    }
}