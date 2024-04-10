<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'tipo_estado_tipos_id',
    ];

    
    public function getTipoProducto()
    {
        return $this->hasOne(TipoProducto::class, 'id', 'tipo_estado_tipos_id');
    }

}
