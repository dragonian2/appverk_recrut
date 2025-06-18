import {postData, getData} from './utils/requests.js';

getData('http://localhost:8080/task/list').then(data => {
    const el = document.getElementsByClassName('js-sortable')[0];
    if (!el) {
        console.error('Element with id "task-list" not found');
        return;
    }
    data.forEach(task => {
        const div = document.createElement('div');
        const deadline = task.deadline ? new Date(task.deadline).toLocaleDateString() : 'brak';
        div.textContent = `ID: ${task.id} | TYTUŁ: ${task.title} | OPIS: ${task.description} | DEADLINE: ${deadline} | Status: ${task.status}`
        div.classList.add('list-group-item');
        div.setAttribute('data-id', task.id);
        el.appendChild(div);

        if (task.subTasks.length > 0) {
            const subTasksDiv = document.createElement('div');
            subTasksDiv.classList.add('js-sortable');
            subTasksDiv.classList.add('list-group');
            task.subTasks.forEach(subTask => {
                const subDiv = document.createElement('div');
                const deadline = subTask.deadline ? new Date(subTask.deadline).toLocaleDateString() : 'brak';
                subDiv.textContent = `ID: ${subTask.id} | TYTUŁ: ${subTask.title} | OPIS: ${subTask.description} | DEADLINE: ${deadline} | Status: ${subTask.status}`;
                subDiv.classList.add('list-group-item', 'sub-task');
                subDiv.setAttribute('data-id', subTask.id);
                subTasksDiv.appendChild(subDiv);
            });
            div.appendChild(subTasksDiv);
        }
    });

    const sortable = Sortable.create(el)

}).catch(error => {
    console.error('Error: ', error);
});