
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="encabezado">
        <div>
            <h2>Gestión de ventas</h2>
            <p>Consulta las ventas y las comisiones calculadas automáticamente.</p>
        </div>

        <a class="btn" href="<?= site_url('ventas/nuevo') ?>">
            + Nueva venta
        </a>
    </div>

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
                        <td colspan="7">No hay ventas registradas.</td>
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