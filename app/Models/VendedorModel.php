<?php

namespace App\Models;

use CodeIgniter\Model;

class VendedorModel extends Model
{
    protected $table            = 'vendedores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nombre',
        'apellido',
        'email',
        'estado'
    ];

    protected $useTimestamps = false;
}