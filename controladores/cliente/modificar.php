<?php

require '../../modelos/Cliente.php';
echo var_dump($_POST);
    $_POST['cli_nombre'] = htmlspecialchars( $_POST['cli_nombre']);
    $_POST['cli_id'] = htmlspecialchars( $_POST['cli_id']);
    $_POST['cli_apellido'] = htmlspecialchars( $_POST['cli_apellido']);
    $_POST['cli_nit'] = htmlspecialchars( $_POST['cli_nit']);
    $_POST['cli_telefono'] = filter_var( $_POST['cli_telefono'] , FILTER_SANITIZE_NUMBER_INT);


if($_POST['cli_nombre'] == '' || !$_POST['cli_apellido'] || $_POST['cli_nit'] == '' || $_POST['cli_telefono'] < 0 ){
    // ALERTA PARA VALIDAR DATOS
    $resultado = [
        'mensaje' => 'LLENAR FORMULARIO ',
        'codigo' => 2
    ];
}else{
    try {
        // REALIZAR CONSULTA
        $producto = new Cliente($_POST);


        $modficar = $producto->modificar();

        $resultado = [
            'mensaje' => 'PRODUCTO MODIFICADO CORRECTAMENTE',
            'codigo' => 1
        ];
        
    } catch (PDOException $pe){
        $resultado = [
            'mensaje' => 'OCURRIO UN ERROR MODIFICANDO EL REGISTRO A LA BD',
            'detalle' => $pe->getMessage(),
            'codigo' => 0
        ];
    } catch (Exception $e) {
        $resultado = [
            'mensaje' => 'OCURRIO UN ERROR EN LA EJECUCIÓN',
            'detalle' => $e->getMessage(),
            'codigo' => 0
        ];
    }
    
}


    $alertas = ['danger', 'success', 'warning'];

    
    include_once '../../vistas/templates/header.php'; ?>

    <div class="row justify-content-center">
        <div class="col-lg-6 alert alert-<?=$alertas[$resultado['codigo']] ?>" role="alert">
            <?= $resultado['mensaje'] ?>
            <?= $resultado['detalle'] ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <a href="../../vistas/cliente/index.php" class="btn btn-primary w-100">Volver al formulario</a>
        </div>
    </div>


<?php include_once '../../vistas/templates/footer.php'; ?>  
