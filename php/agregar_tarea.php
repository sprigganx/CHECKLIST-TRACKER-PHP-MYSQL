<?php
    require_once('../class/checklist.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['title'];
        $descripcion = $_POST['description'];
        $responsable = $_POST['manager'];
        $fechaCompromiso = $_POST['engagementdate'];
        $estado = $_POST['status'];
        $tipoTarea = $_POST['TaskType'];

        // Crea una instancia de la clase Checklist con los datos
        $nuevaTarea = new Checklist();
        // Agrega la tarea
        $nuevaTarea->agregarTarea($titulo, $descripcion, $responsable, $fechaCompromiso, $estado, $tipoTarea);
        // Redirige al usuario de vuelta a la página principal
        header('Location: ../checklist_index.html');
    }
?>
