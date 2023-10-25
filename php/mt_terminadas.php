<?php
require_once('../class/checklist.php');

// Crea una instancia de la clase Checklist con los datos
$checklist = new Checklist();
// Muestra la tarea por el estado: terminada
$tareasPorHacer = $checklist->mostrarTareasPorEstado('terminada');

foreach ($tareasPorHacer as $tarea) {
    // Muestra las tareas terminada en esta sección
    echo '<div class="task">';
    echo '<h3 class="task-title">' . $tarea['titulo'] . '</h3>';
    echo '<p><strong>Descripción:</strong> ' . $tarea['descripcion'] . '</p>';
    echo '<p><strong>Responsable:</strong> ' . $tarea['responsable'] . '</p>';
    echo '<p><strong>Fecha de Compromiso:</strong> ' . $tarea['fecha_compromiso'] . '</p>';
    echo '<p><strong>Estado:</strong> ' . $tarea['estado'] . '</p>';
    echo '<p><strong>Tipo de Tarea:</strong> ' . $tarea['tipo_tarea'] . '</p>';
    echo '</div>';
    echo '<hr>';
}
?>
