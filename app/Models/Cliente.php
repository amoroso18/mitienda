<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento_id',
        'documento_identidad',
        'codigo_documento',
        'denominacion',
        'direccion',
        'telefono',
        'email',
    ];
    
    public function getTipoCliente()
    {
        return $this->hasOne(TipoCliente::class, 'id', 'tipo_documento_id');
    }

}
