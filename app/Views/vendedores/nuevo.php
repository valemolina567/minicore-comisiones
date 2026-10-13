
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card formulario">
    <h2>Registrar vendedor</h2>
    <p>Completa los datos para registrar un nuevo vendedor.</p>

    <form action="<?= site_url('vendedores/guardar') ?>" method="post">
        <?= csrf_field() ?>

        <label for="nombre">Nombre</label>
        <input
            type="text"
            id="nombre"
            name="nombre"
            value="<?= esc(old('nombre') ?? '') ?>"
            maxlength="100"
            required
        >

        <label for="apellido">Apellido</label>
        <input
            type="text"
            id="apellido"
            name="apellido"
            value="<?= esc(old('apellido') ?? '') ?>"
            maxlength="100"
            required
        >

        <label for="email">Correo electrónico</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= esc(old('email') ?? '') ?>"
            maxlength="150"
        >

        <div class="acciones">
            <button class="btn" type="submit">Guardar vendedor</button>
            <a class="btn secundario" href="<?= site_url('vendedores') ?>">
                Cancelar
            </a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>