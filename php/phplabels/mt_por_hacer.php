<?php
require_once('../../class/checklist.php');

// Crea una instancia de la clase Checklist con los datos
$checklist = new Checklist();
// Muestra la tarea por el estado: por hacer
$tareasPorHacer = $checklist->mostrarTareasPorEstado('por hacer');

foreach ($tareasPorHacer as $tarea) {
    // Muestra las tareas terminada en esta sección
    echo '<div>';
    echo '<h3> Title: ' . $tarea['titulo'] . '</h3>';
    echo '<p><strong>Description:</strong> ' . $tarea['descripcion'] . '</p>';
    echo '<p><strong>Manager:</strong> ' . $tarea['responsable'] . '</p>';
    echo '<p><strong>Engagement date:</strong> ' . $tarea['fecha_compromiso'] . '</p>';
    echo '<p><strong>Status:</strong> ' . $tarea['estado'] . '</p>';
    echo '<p><strong>Task Type:</strong> ' . $tarea['tipo_tarea'] . '</p>';
    echo '</div>';
    // Agrega el botón de eliminar
    echo '<form action="../eliminar_tarea.php" method="post">';
    echo '<input type="hidden" name="id_tarea" value="' . $tarea['id'] . '">';
    echo '<input type="submit" value="Delete">';
    echo '</form>';

    // Agrega el botón de editar con un enlace a la página de edición
    echo '<a href="../editar_tarea.php?id=' . $tarea['id'] . '">Edit</a>';
    echo '<hr>';
}
?>
