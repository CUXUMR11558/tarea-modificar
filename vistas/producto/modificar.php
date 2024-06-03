<?php

    require '../../modelos/Producto.php';
    
    $_GET['prod_id'] = filter_var( base64_decode($_GET['prod_id']), FILTER_SANITIZE_NUMBER_INT);
    $producto = new Producto();

    $productoRegistrado = $producto->buscarPorId($_GET['prod_id']);
    var_dump($productoRegistrado);
?>

<?php include_once '../templates/header.php'; ?>

<h1 class="text-center">Formulario de modificación de productos</h1>
<div class="row justify-content-center">
    <form action="/crud_2024/controladores/producto/modificar.php" method="POST" class="border bg-light shadow rounded p-4 col-lg-6">
        
        <input type="" name="prod_id" id="prod_id" value="<?= $productoRegistrado['prod_id']?>">
        <div class="row mb-3">
            <div class="col">
                <label for="prod_nombre">Nombre del producto</label>
                <input type="text" name="prod_nombre" id="prod_nombre" class="form-control" required value="<?= $productoRegistrado['prod_nombre'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="prod_precio">Precio del producto</label>
                <input type="text" name="prod_precio" id="prod_precio" min="0" step="0.01" class="form-control" required value="<?= $productoRegistrado['prod_precio'] ?>">
            </div>
        </div>
        <!-- <input type="datetime-local" name="" id="" value="2024-02-05T05:00"> -->
        <div class="row mb-3">
            <div class="col">
                <button type="submit" class="btn btn-warning w-100">Modificar</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="../../controladores/producto/buscar.php" class="btn btn-secondary w-100">Cancelar</a>
            </div>
        </div>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>