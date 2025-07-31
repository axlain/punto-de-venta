<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartado extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente', 'fecha', 'total', 'monto', 'restante',
        'pagado', 'producto_id', 'producto_manual', 'precio_manual'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
