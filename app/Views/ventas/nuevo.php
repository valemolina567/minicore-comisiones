
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card formulario">
    <h2>Registrar venta</h2>
    <p>Ingresa los datos de la venta y selecciona al vendedor responsable.</p>

    <?php if (empty($vendedores)): ?>
        <div class="mensaje error">
            Primero debes registrar al menos un vendedor activo.
        </div>
    <?php else: ?>
        <form action="<?= site_url('ventas/guardar') ?>" method="post">
            <?= csrf_field() ?>

            <label for="vendedor_id">Vendedor</label>
            <select id="vendedor_id" name="vendedor_id" required>
                <option value="">Selecciona un vendedor</option>
                <?php foreach ($vendedores as $vendedor): ?>
                    <option
                        value="<?= esc($vendedor['id']) ?>"
                        <?= (string) old('vendedor_id') === (string) $vendedor['id'] ? 'selected' : '' ?>
                    >
                        <?= esc($vendedor['nombre'] . ' ' . $vendedor['apellido']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="fecha_venta">Fecha de venta</label>
            <input
                type="date"
                id="fecha_venta"
                name="fecha_venta"
                value="<?= esc(old('fecha_venta') ?? date('Y-m-d')) ?>"
                required
            >

            <label for="descripcion">Descripción</label>
            <input
                type="text"
                id="descripcion"
                name="descripcion"
                value="<?= esc(old('descripcion') ?? '') ?>"
                maxlength="255"
                placeholder="Ej. Laptop, teclado, monitor..."
                required
            >

            <label for="monto">Monto de la venta ($)</label>
            <input
                type="number"
                id="monto"
                name="monto"
                value="<?= esc(old('monto') ?? '') ?>"
                min="0.01"
                step="0.01"
                placeholder="Ej. 1200.00"
                required
            >

            <div class="acciones">
                <button class="btn" type="submit">Guardar venta</button>
                <a class="btn secundario" href="<?= site_url('ventas') ?>">
                    Cancelar
                </a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>