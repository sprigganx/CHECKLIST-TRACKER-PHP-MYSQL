function addTask() {
    var title = document.getElementById("title").value;
    var description = document.getElementById("description").value;
    var manager = document.getElementById("manager").value;
    var engagementDate = document.getElementById("engagementdate").value;
    var status = document.getElementById("status").value;
    var taskType = document.getElementById("TaskType").value;

    var data = {
        "titulo": title,
        "descripcion": description,
        "responsable": manager,
        "fechaCompromiso": engagementDate,
        "estado": status,
        "tipoTarea": taskType
    };

    fetch('http://localhost/Checklist-Tracker-PHP/api/checklist/agregarTarea.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            // La tarea se agregó correctamente, recarga la página
            window.location.reload();
        } else {
            console.error('Error al agregar la tarea:', response.statusText);
        }
    })
    .catch(error => console.error('Error:', error));
}
