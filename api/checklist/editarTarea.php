<?php
    /* 
        * Poner PUT donde dice POST en POSTMAN
        * URL:
        * http://localhost/Checklist-Tracker-PHP/api/checklist/editarTarea.php

        *Ejemplo de datos para ingresar:
        *{
            "idTarea": 52,
            "titulo": "Nueva tarea",
            "descripcion": "Descripcion actualizada",
            "responsable": "Oscar",
            "fechaCompromiso": "2023-12-31",
            "estado": "en progreso",
            "tipoTarea": "taller"
        *}
    */

    // Encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
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
   /*  if (
        !empty($data->idTarea) &&
        !empty($data->titulo) &&
        !empty($data->descripcion) &&
        !empty($data->responsable) &&
        !empty($data->fechaCompromiso) &&
        !empty($data->estado) &&
        !empty($data->tipoTarea)
    ) { */
        // Llamar a la función editarTarea con los argumentos adecuados
        if ($checklist->editarTarea(
            $data->idTarea,
            $data->titulo,
            $data->descripcion,
            $data->responsable,
            $data->fechaCompromiso,
            $data->estado,
            $data->tipoTarea
        )) {
            // Asignar código de respuesta - 200 OK
            http_response_code(200);
            // Informar al usuario
            echo json_encode(array("message" => "La tarea ha sido editada."));
        } else {
            // Si no se puede editar la tarea, informar al usuario
            // Asignar código de respuesta - 503 servicio no disponible
            http_response_code(503);
            // Informar al usuario
            echo json_encode(array("message" => "No se puede editar la tarea."));
        }
    /* }
    // Informar al usuario que los datos están incompletos
    else {
        // Asignar código de respuesta - 400 solicitud incorrecta
        http_response_code(400);
        // Informar al usuario
        echo json_encode(array("message" => "No se puede editar la tarea. Los datos están incompletos."));
    } */
?>