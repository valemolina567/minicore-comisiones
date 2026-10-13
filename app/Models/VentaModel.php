<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table            = 'ventas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'vendedor_id',
        'fecha_venta',
        'descripcion',
        'monto',
        'porcentaje_comision',
        'valor_comision'
    ];

    protected $useTimestamps = false;
}