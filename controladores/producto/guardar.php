<?php 
    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);
    require '../../modelos/Producto.php';
  
    $mensaje = '';
    $precio =  $_POST['prod_precio'];
    // VALIDAR INFORMACION
    $_POST['prod_nombre'] = htmlspecialchars( $_POST['prod_nombre']);
    $_POST['prod_precio'] = filter_var( $precio , FILTER_VALIDATE_FLOAT) ;
    // $regex = '/^(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/';

    // $_POST['prod_fecha'] = filter_var($_POST['prod_fecha'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $regex)));
    // $_POST['prod_fecha'] = str_replace('T', ' ', $_POST['prod_fecha']);
    // $_POST['prod_fecha'] = date("Y-m-d H:i", strtotime($_POST['prod_fecha']));
    
    if($_POST['prod_nombre'] == '' || !$_POST['prod_precio'] || $_POST['prod_precio'] < 0 ){
        // ALERTA PARA VALIDAR DATOS
        $resultado = [
            'mensaje' => 'DEBE VALIDAR LOS DATOS',
            'codigo' => 2
        ];
    }else{
        try {
            // REALIZAR CONSULTA
            $producto = new Producto($_POST);
            $guardar = $producto->guardar();
            $resultado = [
                'mensaje' => 'PRODUCTO INSERTADO CORRECTAMENTE',
                'codigo' => 1
            ];
            
        } catch (PDOException $pe){
            $resultado = [
                'mensaje' => 'OCURRIO UN ERROR INSERTANDO A LA BD',
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


    // $alerta = 'success';

    // switch ($resultado['codigo']) {
    //     case 0:
    //         $alerta = 'danger';
    //         break;
    //     case 1:
    //         $alerta = 'success';
    //         break;
    //     case 2:
    //         $alerta = 'warning';
    //         break;
    // }

        //      [0      ,    1      ,    2   ]
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
            <a href="../../vistas/producto/index.php" class="btn btn-primary w-100">Volver al formulario</a>
        </div>
    </div>


<?php include_once '../../vistas/templates/footer.php'; ?>  