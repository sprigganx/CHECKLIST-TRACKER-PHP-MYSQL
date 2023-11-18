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
    .then(response => response.json())
    .then(data => {
        console.log(data); // Puedes manejar la respuesta de la API aquí
        window.location.reload();
    })
    .catch(error => console.error('Error:', error));
}
