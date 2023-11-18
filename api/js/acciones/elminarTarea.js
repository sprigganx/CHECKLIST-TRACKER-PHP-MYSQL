// URL de la API REST para eliminar una tarea
var apiUrl = 'http://localhost/Checklist-Tracker-PHP/api/checklist/eliminarTarea.php';

function deleteTask(taskId) {
    // Configuración de la solicitud
    var requestOptions = {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ "idTarea": taskId }),
    };

    // Realizar la solicitud fetch
    fetch(apiUrl, requestOptions)
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta de la API
            console.log(data.message); // Mensaje de la API
            window.location.reload();
        })
        .catch(error => {
            console.error('Error al eliminar la tarea:', error);
        });
}