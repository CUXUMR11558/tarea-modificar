<?php
    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);
    require '../../modelos/Cliente.php';

    // consulta
    try {
        var_dump($_GET);
        $_GET['cli_nombre'] = htmlspecialchars( $_GET['cli_nombre']);
        $_GET['cli_id'] = htmlspecialchars( $_GET['cli_id']);
        $_GET['cli_apellido'] = htmlspecialchars( $_GET['cli_apellido']);
        $_GET['cli_nit'] = htmlspecialchars( $_GET['cli_nit']);
        $_GET['cli_telefono'] = filter_var( $_GET['cli_telefono'] , FILTER_SANITIZE_NUMBER_INT);
        $objCliente = new Cliente($_GET);
        $clientes = $objCliente->buscar();
        $resultado = [
            'mensaje' => 'Datos encontrados',
            'datos' => $clientes,
            'codigo' => 1
        ];
        // var_dump($productos);
        
    } catch (Exception $e) {
        $resultado = [
            'mensaje' => 'OCURRIO UN ERROR EN LA EJECUCIÓN',
            'detalle' => $e->getMessage(),
            'codigo' => 0
        ];
    }       


    $alertas = ['danger', 'success', 'warning'];

    
    include_once '../../vistas/templates/header.php'; ?>

    <div class="row mb-4 justify-content-center">
        <div class="col-lg-6 alert alert-<?=$alertas[$resultado['codigo']] ?>" role="alert">
            <?= $resultado['mensaje'] ?>
        </div>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-lg-6">
            <a href="../../vistas/cliente/buscar.php" class="btn btn-primary w-100">Volver al formulario de busqueda</a>
        </div>
    </div>
    <h1 class="text-center">Listado de clientes</h1>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>NIT</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($resultado['codigo'] == 1 && count($clientes) > 0) : ?>
                        <?php foreach ($clientes as $key => $cliente) : ?>
                            <tr>
                                <td><?= $key + 1?></td>
                                <td><?= $cliente['cli_nombre'] . " " . $cliente['cli_apellido'] ?></td>
                                <td><?= $cliente['cli_nit'] ?></td>
                                <td><?= $cliente['cli_telefono'] ?></td>
                                <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/crud_2024/vistas/cliente/modificar.php?cli_id=<?= base64_encode($cliente['cli_id'])?>"><i class="bi bi-pencil-square me-2"></i>Modificar</a></li>
                                        <li><a class="dropdown-item" href="/crud_2024/controladores/cliente/eliminar.php?cli_id=<?= base64_encode($cliente['cli_id'])?>">"><i class="bi bi-trash me-2"></i>Eliminar</a></li>
                                    </ul>
                                </div>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">No hay productos registrados</td>
                        </tr>  
                    <?php endif ?>
                </tbody>
                        
            </table>
        </div>        
    </div>        
<?php include_once '../../vistas/templates/footer.php'; ?>  