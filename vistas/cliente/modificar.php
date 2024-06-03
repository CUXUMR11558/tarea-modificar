<?php

    require '../../modelos/Cliente.php';
    
    $_GET['cli_id'] = filter_var( base64_decode($_GET['cli_id']), FILTER_SANITIZE_NUMBER_INT);
    
    $producto = new Cliente();
    $productoRegistrado = $producto->buscarPorId($_GET['cli_id']);
    var_dump($productoRegistrado);
?>

<?php include_once '../templates/header.php'; ?>

<h1 class="text-center">Formulario de modificación de cliente</h1>
<div class="row justify-content-center">
   

    <form action="/crud_2024/controladores/cliente/modificar.php" method="POST" class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="row mb-3">
        <input type="hidden" name="cli_id" id="cli_id" value="<?= $productoRegistrado['cli_id']?>">
            <div class="col">
                <label for="cli_nombre">Nombre del cliente</label>
                <input type="text" name="cli_nombre" id="cli_nombre" class="form-control" value="<?= $productoRegistrado['cli_nombre']?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cli_apellido">Apellido del cliente</label>
                <input type="text" name="cli_apellido" id="cli_apellido" class="form-control" value="<?= $productoRegistrado['cli_apellido']?>"required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cli_nit">NIT del cliente</label>
                <input type="number" name="cli_nit" id="cli_nit" step="1" class="form-control"  value="<?= $productoRegistrado['cli_nit']?>"required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cli_telefono">Teléfono del cliente</label>
                <input type="tel" name="cli_telefono" id="cli_telefono" step="1" class="form-control" value="<?= $productoRegistrado['cli_telefono']?>"required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
            <button type="submit" class="btn btn-warning w-100">Modificar</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <a href="../../controladores/cliente/buscar.php" class="btn btn-secondary w-100">Cancelar</a>
            </div>
        </div>
    </form>

<?php include_once '../templates/footer.php'; ?>