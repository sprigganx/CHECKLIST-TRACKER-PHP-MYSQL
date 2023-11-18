function editarTareaEnServidor(data) {
    const url = 'http://localhost/Checklist-Tracker-PHP/api/checklist/editarTarea.php';

    const requestOptions = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    };

    return fetch(url, requestOptions)
        .then(response => response.json())
        .then(data => {
            console.log('Respuesta del servidor:', data);
            // Puedes realizar más acciones aquí si es necesario
            return data;  // Devolver los datos si es necesario
        })
        .catch(error => {
            console.error('Error al realizar la solicitud:', error);
            // Manejar errores aquí
            throw error;  // Relanzar el error para que el código que llama pueda manejarlo
        });
}

function obtenerTareaPorId(idTarea) {
    const apiUrl = `http://localhost/Checklist-Tracker-PHP/api/checklist/obtenerTareaPorId.php?id=${idTarea}`;
  
    return fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(tarea => tarea)
        .catch(error => {
            console.error('Error al obtener datos de la tarea:', error.message);
            throw error.message;
        });
  }