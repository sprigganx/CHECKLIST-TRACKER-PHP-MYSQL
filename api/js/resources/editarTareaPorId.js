// Obtener el ID de la tarea de los parámetros de la URL
const urlParams = new URLSearchParams(window.location.search);
const taskId = urlParams.get('id');

// Llamar a la función para obtener los datos de la tarea
obtenerTareaPorId(taskId)
    .then(taskData => {
        // Rellenar el formulario con la información de la tarea
        document.getElementById('titulo').value = taskData.titulo;
        document.getElementById('descripcion').value = taskData.descripcion;
        document.getElementById('responsable').value = taskData.responsable;
        document.getElementById('fecha_compromiso').value = taskData.fechaCompromiso;
        document.getElementById('estado').value = taskData.estado;
        document.getElementById('tipo_tarea').value = taskData.tipoTarea;
    })
    .catch(error => {
        // Manejar errores
        console.error('Error al obtener datos de la tarea:', error);
    });

// Manejar la presentación del formulario
document.getElementById('editTaskForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Obtener los valores del formulario
    const formData = {
        idTarea: taskId,
        titulo: document.getElementById('titulo').value,
        descripcion: document.getElementById('descripcion').value,
        responsable: document.getElementById('responsable').value,
        fechaCompromiso: document.getElementById('fecha_compromiso').value,
        estado: document.getElementById('estado').value,
        tipoTarea: document.getElementById('tipo_tarea').value,
    };

    // Llamar a la función para editar la tarea en el servidor
    editarTareaEnServidor(formData)
        .then(resultado => {
            // Manejar el resultado si es necesario
            console.log('Tarea editada con éxito:', resultado);
            // Mostrar mensaje de éxito y recargar la página principal
            if (resultado) {
                const editadoMessage = document.createElement("div");
                editadoMessage.style.color = "green";
                editadoMessage.style.fontWeight = "bold";
                editadoMessage.textContent = "Editado";
                document.body.appendChild(editadoMessage);

                setTimeout(function () {
                    editadoMessage.style.display = "none";
                    window.parent.location.reload();
                }, 1000);
            }
        })
        .catch(error => {
            // Manejar el error si es necesario
            console.error('Error al editar la tarea:', error);
        });
});