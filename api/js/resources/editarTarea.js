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
            return data;  // Devolver los datos si es necesario
        })
        .catch(error => {
            console.error('Error al realizar la solicitud:', error);
            throw error;
        });
}