<?php
    /* 
        * Poner POST en POSTMAN
        * URL:
        * http://localhost/Checklist-Tracker-PHP/api/checklist/obtenerTareaPorId.php?id=60
    */

    // Encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // Incluir archivos de conexión y objetos
    include_once '../config/conexion.php';
    include_once '../objects/checklist.php';

    // Inicializar la base de datos y el objeto checklist
    $conex = new Conexion();
    $db = $conex->obtenerConexion();
    $checklist = new Checklist($db);

    // Recuperar ID de tarea de la solicitud
    $idTarea = isset($_GET['id']) ? $_GET['id'] : die();

    // Obtener tarea por ID
    $tarea = $checklist->obtenerTareaPorId($idTarea);
    // Verificar si se encontró la tarea
    if ($tarea) {
        // Arreglo de tarea
        $tarea_arr = array(
            "id" => $tarea["id"],
            "titulo" => $tarea["titulo"],
            "descripcion" => html_entity_decode($tarea["descripcion"]),
            "responsable" => $tarea["responsable"],
            "fechaCompromiso" => $tarea["fecha_compromiso"],
            "estado" => $tarea["estado"],
            "tipoTarea" => $tarea["tipo_tarea"]
        );
        // Asignar código de respuesta - 200 OK
        http_response_code(200);
        // Mostrar tarea en formato JSON
        echo json_encode($tarea_arr);
    } else {
        // Asignar código de respuesta - 404 No encontrado
        http_response_code(404);
        // Informar al usuario que no se encontró la tarea
        echo json_encode(array("message" => "No se encontró la tarea con el ID proporcionado."));
    }
?>