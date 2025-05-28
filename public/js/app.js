// JavaScript code for the To-Do application

document.addEventListener('DOMContentLoaded', function() {
    const todoInput = document.getElementById('todo-input');
    const addButton = document.getElementById('add-todo-btn');
    const todoList = document.getElementById('todo-list');

    // Function to fetch todos from the server
    function fetchTodos() {
        fetch('api/get_todos.php')
            .then(response => response.json())
            .then(data => {
                todoList.innerHTML = '';
                data.forEach(todo => {
                    const li = document.createElement('li');
                    li.textContent = todo.task;
                    li.setAttribute('data-id', todo.id);
                    li.appendChild(createDeleteButton(todo.id));
                    todoList.appendChild(li);
                });
            });
    }

    // Function to create a delete button for each todo
    function createDeleteButton(id) {
        const button = document.createElement('button');
        button.textContent = 'Remove';
        button.onclick = function() {
            deleteTodo(id);
        };
        return button;
    }

    // Function to add a new todo
    addButton.addEventListener('click', function() {
        const task = todoInput.value.trim();
        if (task) {
            fetch('api/add_todo.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ task: task })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchTodos();
                    todoInput.value = '';
                } else {
                    alert('Error adding todo');
                }
            });
        }
    });

    // Function to delete a todo
    function deleteTodo(id) {
        fetch('api/delete_todo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchTodos();
            } else {
                alert('Error deleting todo');
            }
        });
    }

    // Initial fetch of todos
    fetchTodos();
});