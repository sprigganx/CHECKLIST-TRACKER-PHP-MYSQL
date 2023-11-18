function loadTasksForStatus (column, iframeId) {
    fetch('http://localhost/Checklist-Tracker-PHP/api/checklist/mostrarTareas.php')
        .then(response => response.json())
        .then(data => {
            // Filtrar tareas según el estado (columna)
            const tasks = data.records.filter(task => task.estado.toLowerCase() === column.toLowerCase());
            const taskHtml = generateTaskHtml(tasks);

            // Actualizar el contenido de la iframe
            const iframe = document.getElementById(iframeId);
            iframe.contentDocument.body.innerHTML = taskHtml;

            // Asignar el evento de clic a cada botón de eliminar después de cargar el contenido
            tasks.forEach(task => {
                const deleteBtn = iframe.contentDocument.getElementById('deleteBtn_' + task.id);
                if (deleteBtn) {
                    deleteBtn.addEventListener('click', function(event) {
                        event.preventDefault();
                        deleteTask(task.id);
                    });
                }
            });
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function () {
    loadTasksForStatus('por hacer', 'todoIframe');
    loadTasksForStatus('en progreso', 'progressIframe');
    loadTasksForStatus('terminada', 'completedIframe');
});
