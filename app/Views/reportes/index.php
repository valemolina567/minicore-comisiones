<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <?php if (!empty($errores)): ?>
        <div style="padding: 12px; margin-bottom: 16px; background: #fee2e2; border-radius: 8px;">
            <?php foreach ($errores as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="encabezado">
        <div>
            <h2>Reportes de ventas y comisiones</h2>
            <p>Consulta las ventas por período y vendedor.</p>
        </div>
    </div>

    <!-- Filtros -->
    <form method="get" action="<?= site_url('reportes') ?>">

        <div style="display: flex; flex-wrap: wrap; gap: 16px; align-items: end; margin-bottom: 24px;">

            <div>
                <label for="fecha_inicio">Fecha inicial</label>
                <input
                    type="date"
                    id="fecha_inicio"
                    name="fecha_inicio"
                    value="<?= esc($fechaInicio ?? '') ?>"
                >
            </div>

            <div>
                <label for="fecha_fin">Fecha final</label>
                <input
                    type="date"
                    id="fecha_fin"
                    name="fecha_fin"
                    value="<?= esc($fechaFin ?? '') ?>"
                >
            </div>

            <div>
                <label for="vendedor_id">Vendedor</label>
                <select id="vendedor_id" name="vendedor_id">
                    <option value="">Todos los vendedores</option>

                    <?php foreach ($vendedores as $vendedor): ?>
                        <option
                            value="<?= esc($vendedor['id']) ?>"
                            <?= (string) ($vendedorId ?? '') === (string) $vendedor['id'] ? 'selected' : '' ?>
                        >
                            <?= esc($vendedor['nombre'] . ' ' . $vendedor['apellido']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn">
                Filtrar
            </button>

            <a href="<?= site_url('reportes') ?>" class="btn">
                Limpiar filtros
            </a>

        </div>
    </form>

    <!-- Resumen -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px;">

        <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <p>Total vendido</p>
            <h2>$<?= number_format($totalVentas, 2) ?></h2>
        </div>

        <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <p>Total de comisiones</p>
            <h2>$<?= number_format($totalComisiones, 2) ?></h2>
        </div>

        <div style="padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <p>Cantidad de ventas</p>
            <h2><?= esc($cantidadVentas) ?></h2>
        </div>

    </div>

    <!-- Tabla de resultados -->
    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Vendedor</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>% Comisión</th>
                    <th>Comisión ($)</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($ventas)): ?>
                    <tr>
                        <td colspan="7">
                            No se encontraron ventas para los filtros seleccionados.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?= esc($venta['id']) ?></td>
                            <td><?= esc($venta['fecha_venta']) ?></td>
                            <td>
                                <?= esc($venta['nombre'] . ' ' . $venta['apellido']) ?>
                            </td>
                            <td><?= esc($venta['descripcion']) ?></td>
                            <td>
                                $<?= number_format((float) $venta['monto'], 2) ?>
                            </td>
                            <td>
                                <?= number_format((float) $venta['porcentaje_comision'], 2) ?>%
                            </td>
                            <td>
                                <strong>
                                    $<?= number_format((float) $venta['valor_comision'], 2) ?>
                                </strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>