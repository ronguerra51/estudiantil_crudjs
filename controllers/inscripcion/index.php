<?php
require '../../models/Inscripcion.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    switch ($metodo) {
        case 'POST':
            $inscripcion = new Inscripcion($_POST);
            switch ($tipo) {
                case '1':
                    $ejecucion = $inscripcion->guardar();
                    $mensaje = "Guardado correctamente";
                    break;

                case '3':
                    $ejecucion = $inscripcion->eliminar();
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
            $inscripcion = new Inscripcion($_GET);
            $inscripciones = $inscripcion->buscar();
            echo json_encode($inscripciones);
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
