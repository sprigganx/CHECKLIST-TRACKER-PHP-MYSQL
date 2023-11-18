<?php
    /* 
        * Poner POST en POSTMAN
        * URL:
        * http://localhost/Checklist-Tracker-PHP/api/checklist/mostrarTareas.php
    */

    // Encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Incluir archivos de conexión y objetos
    include_once '../config/conexion.php';
    include_once '../objects/checklist.php';

    // Inicializar la base de datos y el objeto checklist
    $conex = new Conexion();
    $db = $conex->obtenerConexion();
    $checklist = new Checklist($db);

    // Query tareas
    $tareas = $checklist->mostrarTareas();
    $num = count($tareas);

    // Verificar si hay más de 0 registros encontrados
    if ($num > 0) {
        // Arreglo de tareas
        $tareas_arr = array();
        $tareas_arr["records"] = array();

        // Obtener todo el contenido de la tabla
        // fetch() es más rápido que fetchAll()
        foreach ($tareas as $tarea) {
            // Extraer fila
            // Esto creará de $tarea['titulo'] a
            // solamente $titulo
            extract($tarea);
            $tarea_item = array(
                "id" => $id,
                "titulo" => $titulo,
                "descripcion" => html_entity_decode($descripcion),
                "responsable" => $responsable,
                "fechaCompromiso" => $fecha_compromiso,
                "estado" => $estado,
                "tipoTarea" => $tipo_tarea
            );
            array_push($tareas_arr["records"], $tarea_item);
        }
        // Asignar código de respuesta - 200 OK
        http_response_code(200);
        // Mostrar tareas en formato JSON
        echo json_encode($tareas_arr);
    } else {
        // Asignar código de respuesta - 404 No encontrado
        http_response_code(404);
        // Informar al usuario que no se encontraron tareas
        echo json_encode(
            array("message" => "No se encontraron tareas.")
        );
    }
?>