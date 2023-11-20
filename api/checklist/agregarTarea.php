<?php
    /* 
        * Poner POST en POSTMAN
        * URL:
        * http://localhost/Checklist-Tracker-PHP/api/checklist/agregarTarea.php

        *Ejemplo de datos para ingresar:
        * {
            "titulo": "Tarea de prueba",
            "descripcion": "Realizar pruebas en Postman",
            "responsable": "Juan",
            "fechaCompromiso": "2023-12-31",
            "estado": "por hacer",
            "tipoTarea": "tarea"
        *}
    */

    // Encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // Incluir archivos de conexión y objetos
    include_once '../config/conexion.php';
    include_once '../objects/checklist.php';

    // Inicializar la conexión a la base de datos
    $conex = new Conexion();
    $db = $conex->obtenerConexion();
    $checklist = new Checklist($db);

    // Obtener datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"));

    // Asegurarse de que los datos no estén vacíos
    if (
        !empty($data->titulo) &&
        !empty($data->descripcion) /* &&
        !empty($data->responsable) &&
        !empty($data->fechaCompromiso) &&
        !empty($data->estado) &&
        !empty($data->tipoTarea) */
    ) {
        // Asignar valores de propiedad a la tarea
        $checklist->titulo = $data->titulo;
        $checklist->descripcion = $data->descripcion;
        $checklist->responsable = $data->responsable;
        $checklist->fechaCompromiso = $data->fechaCompromiso;
        $checklist->estado = $data->estado;
        $checklist->tipoTarea = $data->tipoTarea;

        // Crear la tarea
        if ($checklist->agregarTarea()) {
            // Asignar código de respuesta - 201 creado
            http_response_code(201);
            // Informar al usuario
            echo json_encode(array("message" => "La tarea ha sido creada."));
        } else {
            // Si no se puede crear la tarea, informar al usuario
            // Asignar código de respuesta - 503 servicio no disponible
            http_response_code(503);
            // Informar al usuario
            echo json_encode(array("message" => "No se puede crear la tarea."));
        }
    }
    // Informar al usuario que los datos están incompletos
    else {
        // Asignar código de respuesta - 400 solicitud incorrecta
        http_response_code(400);
        // Informar al usuario
        echo json_encode(array("message" => "No se puede crear la tarea. Los datos están incompletos."));
    }
?>