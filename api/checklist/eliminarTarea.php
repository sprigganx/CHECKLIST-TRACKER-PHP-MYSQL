<?php
    /* 
        * Poner DELETE donde dice POST en POSTMAN
        * URL:
        * http://localhost/Checklist-Tracker-PHP/api/checklist/eliminarTarea.php

        *Ejemplo de datos para ingresar:
        *{
            "idTarea": 53
        *}
    */

    // Encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // Obtener conexión a la base de datos
    include_once '../config/conexion.php';
    include_once '../objects/checklist.php';

    // Inicializar la conexión a la base de datos
    $conex = new Conexion();
    $db = $conex->obtenerConexion();
    $checklist = new Checklist($db);

    // Obtener datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"));

    // Asegurarse de que los datos no estén vacíos
    if (!empty($data->idTarea)) {
        // Llamar a la función eliminarTarea con el argumento adecuado
        if ($checklist->eliminarTarea($data->idTarea)) {
            // Asignar código de respuesta - 200 OK
            http_response_code(200);
            // Informar al usuario
            echo json_encode(array("message" => "La tarea ha sido eliminada."));
        } else {
            // Si no se puede eliminar la tarea, informar al usuario
            // Asignar código de respuesta - 503 servicio no disponible
            http_response_code(503);
            // Informar al usuario
            echo json_encode(array("message" => "No se puede eliminar la tarea."));
        }
    }
    // Informar al usuario que los datos están incompletos
    else {
        // Asignar código de respuesta - 400 solicitud incorrecta
        http_response_code(400);
        // Informar al usuario
        echo json_encode(array("message" => "No se puede eliminar la tarea. Los datos están incompletos."));
    }
?>
