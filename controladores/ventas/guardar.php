<?php

    require '../../modelos/Encabezado.php';
    
    // VALIDAR INFORMACION
    $_POST['fact_cliente'] = filter_var( $_POST['fact_cliente'] , FILTER_SANITIZE_NUMBER_INT);
    $regex = '/^(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/';

    $_POST['fact_fecha'] = filter_var($_POST['fact_fecha'], FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => $regex]]);
 

    if($_POST['fact_cliente'] == '' || !$_POST['fact_fecha'] ){
        $resultado = [
            'mensaje' => 'DEBE VALIDAR LOS DATOS',
            'codigo' => 2
        ];
    }else{
        // var_dump($_POST);
    }
    #TODO
    // VALIDAR LOS PRODUCTOS Y LA CANTIDADES
    // ENVIAR LOS DATOS A FACTURA
    // enviar los datos a detalles
    // MANEJO DE TRANSACCIONES EN LA BD