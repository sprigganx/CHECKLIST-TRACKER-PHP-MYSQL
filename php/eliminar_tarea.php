<?php
require_once('../class/checklist.php');

if (isset($_POST['id_tarea'])) {
    $id_tarea = $_POST['id_tarea'];

    // Crea una instancia de la clase Checklist
    $checklist = new Checklist();

    // Llama a la función para eliminar la tarea
    $resultado = $checklist->eliminarTarea($id_tarea);

    if ($resultado) {
        // La tarea se eliminó exitosamente
        echo '<script>
            // Recarga la página principal
            top.location.reload();
        </script>';
    } else {
        // Ocurrió un error al eliminar la tarea
        echo 'Error al eliminar la tarea.';
    }
} else {
    // Si no se proporcionó un ID de tarea válido
    echo 'ID de tarea no válido.';
}
?>
