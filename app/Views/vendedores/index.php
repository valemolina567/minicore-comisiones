
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="encabezado">
        <div>
            <h2>Gestión de vendedores</h2>
            <p>Consulta los vendedores registrados en el sistema.</p>
        </div>
        <a class="btn" href="<?= site_url('vendedores/nuevo') ?>">
            + Nuevo vendedor
        </a>
    </div>

    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo electrónico</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($vendedores)): ?>
                    <tr>
                        <td colspan="5">No hay vendedores registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($vendedores as $vendedor): ?>
                        <tr>
                            <td><?= esc($vendedor['id']) ?></td>
                            <td><?= esc($vendedor['nombre']) ?></td>
                            <td><?= esc($vendedor['apellido']) ?></td>
                            <td><?= esc($vendedor['email'] ?? '') ?></td>
                            <td>
                                <?= $vendedor['estado'] ? 'Activo' : 'Inactivo' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>