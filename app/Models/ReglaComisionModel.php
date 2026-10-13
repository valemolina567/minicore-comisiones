<?php

namespace App\Models;

use CodeIgniter\Model;

class ReglaComisionModel extends Model
{
    protected $table            = 'reglas_comision';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nombre',
        'monto_minimo',
        'monto_maximo',
        'porcentaje',
        'estado'
    ];

    protected $useTimestamps = false;
}