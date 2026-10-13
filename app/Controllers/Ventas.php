<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\VendedorModel;
use App\Models\ReglaComisionModel;

class Ventas extends BaseController
{
    protected VentaModel $ventaModel;
    protected VendedorModel $vendedorModel;
    protected ReglaComisionModel $reglaComisionModel;

    public function __construct()
    {
        $this->ventaModel = new VentaModel();
        $this->vendedorModel = new VendedorModel();
        $this->reglaComisionModel = new ReglaComisionModel();
    }

    public function index()
    {
        $ventas = $this->ventaModel
            ->select('ventas.*, vendedores.nombre, vendedores.apellido')
            ->join('vendedores', 'vendedores.id = ventas.vendedor_id')
            ->orderBy('ventas.fecha_venta', 'DESC')
            ->orderBy('ventas.id', 'DESC')
            ->findAll();

        return view('ventas/index', [
            'titulo' => 'Gestión de ventas',
            'ventas' => $ventas
        ]);
    }

    public function nuevo()
    {
        $vendedores = $this->vendedorModel
            ->where('estado', 1)
            ->orderBy('nombre', 'ASC')
            ->findAll();

        return view('ventas/nuevo', [
            'titulo' => 'Registrar venta',
            'vendedores' => $vendedores
        ]);
    }

    public function guardar()
    {
        $reglasValidacion = [
            'vendedor_id' => 'required|is_natural_no_zero',
            'fecha_venta' => 'required|valid_date[Y-m-d]',
            'descripcion' => 'required|min_length[2]|max_length[255]',
            'monto' => 'required|decimal|greater_than[0]'
        ];

        if (!$this->validate($reglasValidacion)) {
            return redirect()->back()
                ->withInput()
                ->with('errores', $this->validator->getErrors());
        }

        $vendedorId = (int) $this->request->getPost('vendedor_id');
        $monto = (float) $this->request->getPost('monto');

        $vendedor = $this->vendedorModel
            ->where('id', $vendedorId)
            ->where('estado', 1)
            ->first();

        if (!$vendedor) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Selecciona un vendedor activo válido.');
        }

        // Obtener las reglas de comisión activas.
        $reglasComision = $this->reglaComisionModel
            ->where('estado', 1)
            ->orderBy('monto_minimo', 'ASC')
            ->findAll();

        // Buscar la regla que corresponde al monto de la venta.
        $reglaAplicada = null;

        foreach ($reglasComision as $regla) {
            $cumpleMinimo = $monto >= (float) $regla['monto_minimo'];

            $cumpleMaximo = $regla['monto_maximo'] === null
                || $monto <= (float) $regla['monto_maximo'];

            if ($cumpleMinimo && $cumpleMaximo) {
                $reglaAplicada = $regla;
                break;
            }
        }

        if ($reglaAplicada === null) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'No existe una regla de comisión para ese monto. Revisa las reglas registradas.'
                );
        }

        // Calcular la comisión y redondearla a dos decimales.
        $porcentaje = (float) $reglaAplicada['porcentaje'];
        $comision = round($monto * $porcentaje / 100, 2);

        // Guardar la venta junto con la comisión calculada.
        $this->ventaModel->insert([
            'vendedor_id' => $vendedorId,
            'fecha_venta' => $this->request->getPost('fecha_venta'),
            'descripcion' => trim($this->request->getPost('descripcion')),
            'monto' => number_format($monto, 2, '.', ''),
            'porcentaje_comision' => number_format($porcentaje, 2, '.', ''),
            'valor_comision' => number_format($comision, 2, '.', '')
        ]);

        return redirect()->to('/ventas')
            ->with('mensaje', 'Venta registrada y comisión calculada correctamente.');
    }
}