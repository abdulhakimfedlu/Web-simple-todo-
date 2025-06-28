function addTask() {
    const taskInput = document.getElementById('taskInput');
    const taskText = taskInput.value.trim();

    if (taskText === '') {
        alert('Please enter a task!');
        return;
    }
    
   
    fetch('add_task.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `task=${encodeURIComponent(taskText)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            taskInput.value = '';
            loadTasks(); 
        } else {
            alert('Error adding task: ' + data.message);
        }
    });
}

function loadTasks() {
    fetch('get_tasks.php')
        .then(response => response.json())
        .then(tasks => {
            const taskList = document.getElementById('taskList');
            taskList.innerHTML = ''; 
            tasks.forEach(task => {
                const li = document.createElement('li');
                li.className = task.completed ? 'completed' : '';
                li.innerHTML = `
                    <span onclick="toggleTask(${task.id}, ${task.completed})">${task.task}</span>
                    <button class="delete-btn" onclick="deleteTask(${task.id})">Delete</button>
                `;
                taskList.appendChild(li);
            });
        });
}

function toggleTask(id, completed) {
    fetch('update_task.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}&completed=${completed ? 0 : 1}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadTasks(); 
        } else {
            alert('Error updating task: ' + data.message);
        }
    });
}

function deleteTask(id) {
    if (confirm('Are you sure you want to delete this task?')) {
        fetch('delete_task.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadTasks(); 
            } else {
                alert('Error deleting task: ' + data.message);
            }
        });
    }
}

// Load tasks when the page loads
document.addEventListener('DOMContentLoaded', loadTasks);
