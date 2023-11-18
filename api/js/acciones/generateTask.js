function generateTaskHtml(tasks) {
    let html = '';
    tasks.forEach(task => {
        html += '<div class="iframe">';
        html += '<h3>Title: ' + task.titulo + '</h3>';
        html += '<p><strong>Description:</strong> ' + task.descripcion + '</p>';
        html += '<p><strong>Manager:</strong> ' + task.responsable + '</p>';
        html += '<p><strong>Engagement date:</strong> ' + task.fechaCompromiso + '</p>';
        html += '<p><strong>Status:</strong> ' + task.estado + '</p>';
        html += '<p><strong>Task Type:</strong> ' + task.tipoTarea + '</p>';
        html += '<form>';
        html += '<input type="hidden" name="id_tarea" value="' + task.id + '">';
        html += '<input type="submit" value="Delete" id="deleteBtn_' + task.id + '">';
        html += '</form>';
        html += '<a href="api/js/acciones/editarTarea.html?id=' + task.id + '">Edit</a>';
        html += '</div>';
        html += '<hr>';
    });

    return html;
}
