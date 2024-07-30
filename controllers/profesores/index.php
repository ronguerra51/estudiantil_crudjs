<?php
require '../../models/Profesor.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    switch ($metodo) {
        case 'POST':
            $profesor = new Profesor($_POST);
            switch ($tipo) {
                case '1':

                    $ejecucion = $profesor->guardar();
                    $mensaje = "Guardado correctamente";
                    break;

                case '2':
                    $ejecucion = $profesor->modificar();
                    $mensaje = "Modificado correctamente";
                    break;

                case '3':
                    $ejecucion = $profesor->eliminar();
                    $mensaje = "Eliminado correctamente";
                    break;

                default:

                    break;
            }
            http_response_code(200);
            echo json_encode([
                "mensaje" => $mensaje,
                "codigo" => 1,
            ]);
            break;

        case 'GET':
            http_response_code(200);
            $profesor = new Profesor($_GET);
            $profesores = $profesor->buscar();
            echo json_encode($profesores);
            break;

        default:
            http_response_code(405);
            echo json_encode([
                "mensaje" => "Método no permitido",
                "codigo" => 9,
            ]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "detalle" => $e->getMessage(),
        "mensaje" => "Error de ejecución",
        "codigo" => 0,
    ]);
}

exit;
