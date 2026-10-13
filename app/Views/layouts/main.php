
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo ?? 'Mini Core de Ventas') ?></title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #243047;
        }

        header {
            background: #172554;
            color: white;
            padding: 20px 6%;
        }

        header h1 { margin: 0 0 14px; font-size: 23px; }

        nav { display: flex; gap: 20px; flex-wrap: wrap; }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        nav a:hover { text-decoration: underline; }

        main {
            width: 90%;
            max-width: 1100px;
            margin: 32px auto;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 3px 12px #0000000d;
            margin-bottom: 20px;
        }

        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        h2 { margin-top: 0; }

        .btn {
            display: inline-block;
            border: none;
            border-radius: 6px;
            padding: 11px 16px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover { background: #1d4ed8; }

        .tabla-contenedor { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 13px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            font-size: 14px;
        }

        th { background: #f8fafc; }

        label {
            display: block;
            font-weight: bold;
            margin: 15px 0 7px;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
        }

        .formulario { max-width: 600px; }

        .mensaje {
            padding: 13px;
            border-radius: 6px;
            margin-bottom: 18px;
        }

        .exito { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }

        .acciones { display: flex; gap: 10px; margin-top: 22px; }
        .secundario { background: #64748b; }
        .estado { color: #15803d; font-weight: bold; }

        footer {
            text-align: center;
            padding: 24px;
            color: #64748b;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Mini Core | Ventas y Comisiones</h1>
        <nav>
            <a href="<?= site_url('vendedores') ?>">Vendedores</a>
            <a href="<?= site_url('ventas') ?>">Ventas</a>
            <a href="<?= site_url('reportes') ?>">Reportes</a>
            <a href="<?= site_url('vendedores/nuevo') ?>">Registrar vendedor</a>
            <a href="<?= site_url('ventas/nuevo') ?>">Registrar venta</a>
        </nav>
    </header>

    <main>
        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="mensaje exito">
                <?= esc(session()->getFlashdata('mensaje')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php $errores = session()->getFlashdata('errores'); ?>
        <?php if ($errores): ?>
            <div class="mensaje error">
                <strong>Revisa los siguientes campos:</strong>
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <footer>
        Mini Core de Ventas y Comisiones · Proyecto académico
    </footer>
</body>
</html>