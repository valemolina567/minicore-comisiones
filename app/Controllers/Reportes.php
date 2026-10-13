<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\VendedorModel;

class Reportes extends BaseController
{
    protected VentaModel $ventaModel;
    protected VendedorModel $vendedorModel;

    public function __construct()
    {
        $this->ventaModel = new VentaModel();
        $this->vendedorModel = new VendedorModel();
    }

    public function index()
    {
        $fechaInicio = $this->request->getGet('fecha_inicio');
        $fechaFin = $this->request->getGet('fecha_fin');
        $vendedorId = $this->request->getGet('vendedor_id');

        $errores = [];

        // Validar el formato de las fechas.
        foreach ([
            'fecha_inicio' => $fechaInicio,
           'fecha_fin' => $fechaFin
        ] as $campo => $fecha) {
            if (
                $fecha !== null &&
                $fecha !== '' &&
                !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)
            ) {
                $errores[] = 'Las fechas deben tener un formato válido.';
                break;
            }

            if (
                $fecha !== null &&
                $fecha !== '' &&
                preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha) &&
                !checkdate(
                    (int) substr($fecha, 5, 2),
                    (int) substr($fecha, 8, 2),
                    (int) substr($fecha, 0, 4)
                )
            ) {
                $errores[] = 'Una de las fechas seleccionadas no existe.';
                break;
            }
        }

        // Validar que la fecha inicial no supere la final.
        if (
            empty($errores) &&
            !empty($fechaInicio) &&
            !empty($fechaFin) &&
            $fechaInicio > $fechaFin
        ) {
            $errores[] = 'La fecha inicial no puede ser posterior a la fecha final.';
        }

        // Validar el identificador del vendedor.
        if (
            $vendedorId !== null &&
            $vendedorId !== '' &&
            (!ctype_digit($vendedorId) || (int) $vendedorId < 1)
        ) {
            $errores[] = 'Selecciona un vendedor válido.';
        }

        $consulta = $this->ventaModel
            ->select('ventas.*, vendedores.nombre, vendedores.apellido')
            ->join('vendedores', 'vendedores.id = ventas.vendedor_id');

        if (empty($errores)) {
            if (!empty($fechaInicio)) {
                $consulta->where('ventas.fecha_venta >=', $fechaInicio);
            }

            if (!empty($fechaFin)) {
                $consulta->where('ventas.fecha_venta <=', $fechaFin);
            }

            if (!empty($vendedorId)) {
                $consulta->where('ventas.vendedor_id', (int) $vendedorId);
            }
        }

        $ventas = $consulta
            ->orderBy('ventas.fecha_venta', 'DESC')
            ->findAll();

        // Si los filtros son inválidos, no mostrar resultados engañosos.
        if (!empty($errores)) {
            $ventas = [];
        }

        $totalVentas = 0;
        $totalComisiones = 0;

        foreach ($ventas as $venta) {
            $totalVentas += (float) $venta['monto'];
            $totalComisiones += (float) $venta['valor_comision'];
        }

        $vendedores = $this->vendedorModel
            ->orderBy('nombre', 'ASC')
            ->findAll();

        return view('reportes/index', [
            'titulo' => 'Reportes de ventas y comisiones',
            'ventas' => $ventas,
            'vendedores' => $vendedores,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'vendedorId' => $vendedorId,
            'totalVentas' => $totalVentas,
            'totalComisiones' => $totalComisiones,
            'cantidadVentas' => count($ventas),
            'errores' => $errores
        ]);
    }
}