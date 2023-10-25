<?php
require_once('../class/checklist.php');

if (isset($_GET['id'])) {
    $id_tarea = $_GET['id'];

    // Crea una instancia de la clase Checklist
    $checklist = new Checklist();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recopila los datos actualizados del formulario
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $responsable = $_POST['responsable'];
        $fechaCompromiso = $_POST['fecha_compromiso'];
        $estado = $_POST['estado'];
        $tipoTarea = $_POST['tipo_tarea'];

        // Llama a la función para editar la tarea
        $resultado = $checklist->editarTarea($id_tarea, $titulo, $descripcion, $responsable, $fechaCompromiso, $estado, $tipoTarea);

        if ($resultado) {
            // La tarea se editó exitosamente
            echo '<div style="color: green; font-weight: bold;">Editado</div>';
            echo '<script>
            setTimeout(function() {
                var editadoMessage = document.querySelector(".editado-message");
                if (editadoMessage) {
                    editadoMessage.style.display = "none";
                }
            }, 5000); // El mensaje "Editado" desaparecerá después de 5 segundos (5000 ms)
            </script>';
        }
    }

    // Obtén los detalles de la tarea a editar
    $tarea = $checklist->obtenerTareaPorId($id_tarea);

    if ($tarea) {
        // Muestra el formulario de edición
        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <!-- Encabezado de tu página -->
        </head>
        <body>
            <h1>Editar Tarea</h1>
            <form action="editar_tarea.php?id=' . $id_tarea . '" method="post">
                <!-- Campos del formulario con datos pre-cargados -->
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" value="' . $tarea['titulo'] . '"><br>

                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" value="' . $tarea['descripcion'] . '"><br>

                <label for="responsable">Responsable:</label>
                <input type="text" name="responsable" value="' . $tarea['responsable'] . '"><br>

                <label for="fecha_compromiso">Fecha de Compromiso:</label>
                <input type="date" name="fecha_compromiso" value="' . $tarea['fecha_compromiso'] . '"><br>

                <label for="estado">Status:</label>
                <select name="estado" id="status">
                    <option value="por hacer" ' . ($tarea['estado'] === 'por hacer' ? 'selected' : '') . '>To be done</option>
                    <option value="en progreso" ' . ($tarea['estado'] === 'en progreso' ? 'selected' : '') . '>In progress</option>
                    <option value="terminada" ' . ($tarea['estado'] === 'terminada' ? 'selected' : '') . '>Completed</option>
                </select><br>
        
                <label for="tipo_tarea">Task Type:</label>
                <select name="tipo_tarea" id="TaskType">
                    <option value="tarea" ' . ($tarea['tipo_tarea'] === 'tarea' ? 'selected' : '') . '>Homework</option>
                    <option value="taller" ' . ($tarea['tipo_tarea'] === 'taller' ? 'selected' : '') . '>Workshop</option>
                    <option value="laboratorio" ' . ($tarea['tipo_tarea'] === 'laboratorio' ? 'selected' : '') . '>Laboratory</option>
                    <option value="asignacion" ' . ($tarea['tipo_tarea'] === 'asignacion' ? 'selected' : '') . '>Assignment</option>
                    <option value="investigacion" ' . ($tarea['tipo_tarea'] === 'investigacion' ? 'selected' : '') . '>Investigation</option>
                    <option value="charla" ' . ($tarea['tipo_tarea'] === 'charla' ? 'selected' : '') . '>Talk</option>
                    <option value="proyecto" ' . ($tarea['tipo_tarea'] === 'proyecto' ? 'selected' : '') . '>Project</option>
                    <option value="parcial" ' . ($tarea['tipo_tarea'] === 'parcial' ? 'selected' : '') . '>Partial</option>
                    <option value="examen" ' . ($tarea['tipo_tarea'] === 'examen' ? 'selected' : '') . '>Exam</option>
                </select><br>

                <input type="submit" value="Guardar Cambios">
            </form>
        </body>
        </html>';
    } else {
        echo 'No se encontró la tarea especificada.';
    }
} else {
    // Si no se proporcionó un ID de tarea válido
    echo 'ID de tarea no válido.';
}
?>
