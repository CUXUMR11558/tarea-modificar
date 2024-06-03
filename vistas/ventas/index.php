<?php 
    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);
    require '../../modelos/Cliente.php';
    require '../../modelos/Producto.php';

    $objCliente = new Cliente();
    $clientes = $objCliente->buscar();
    $objProducto = new Producto();
    $productos = $objProducto->buscar();
    // var_dump($productos);
?>

<?php include_once '../templates/header.php'; ?>

<h1 class="text-center">Ventas</h1>
<div class="row justify-content-center">
    <form action="/crud_2024/controladores/ventas/guardar.php" method="POST" class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="row mb-3">
            <div class="col">
                <label for="fact_fecha">Fecha de la venta</label>
                <input type="date" name="fact_fecha" id="fact_fecha" class="form-control" required  value="<?= date('Y-m-d') ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="fact_cliente"></label>
                <select name="fact_cliente" id="fact_cliente" class="form-control" required>
                    <option value="">SELECCIONE...</option>
                    <?php foreach ($clientes as $cliente) : ?>
                        <option value="<?= $cliente['cli_id'] ?>"> <?= $cliente['cli_nombre'] . " " . $cliente['cli_apellido'] . " (" . $cliente['cli_nit'] . ")"  ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <h5>Detalle de productos</h5>
        <hr>
        <?php for($i = 1; $i <= 5; $i++) : ?>
            <div class="row mb-3">
                <div class="col-lg-9">
                    <label for="producto<?=$i?>">Producto <?=$i?></label>
                    <select name="producto[]" id="producto<?=$i?>" class="form-control">
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($productos as $producto) : ?>
                            <option value="<?= $producto['prod_id'] ?>"> <?= $producto['prod_nombre'] . " (" . $producto['prod_precio'] . ")"  ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label for="cantidad<?=$i?>">Cantidad <?=$i?></label>
                    <input type="number" min="0" class="form-control" step="1" name="cantidad" id="cantidad<?=$i?>">
                </div>
            </div>
        <?php endfor?>
        
        <div class="row mb-3">
            <div class="col">
                <button type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="../../controladores/producto/buscar.php" class="btn btn-info w-100">Buscar</a>
            </div>
        </div>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>

