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