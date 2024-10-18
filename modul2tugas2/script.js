let todoList = [];

function addTodo() {
    const todoInput = document.getElementById('todo-input');
    const todoText = todoInput.value.trim();
    
    if (todoText === '') {
        alert('Please enter a task!');
        return;
    }

    const todoItem = {
        id: Date.now(),
        text: todoText,
        isEditing: false
    };

    todoList.push(todoItem);
    todoInput.value = ''; // Clear input field
    renderTodoList();
}

function deleteTodo(id) {
    todoList = todoList.filter(todo => todo.id !== id);
    renderTodoList();
}

function editTodo(id) {
    todoList = todoList.map(todo => {
        if (todo.id === id) {
            const newText = prompt('Edit your task:', todo.text);
            if (newText) {
                todo.text = newText;
            }
        }
        return todo;
    });
    renderTodoList();
}

function renderTodoList() {
    const todoListElement = document.getElementById('todo-list');
    todoListElement.innerHTML = '';

    todoList.forEach(todo => {
        const listItem = document.createElement('li');
        listItem.textContent = todo.text;

        const actionsDiv = document.createElement('div');
        actionsDiv.classList.add('actions');

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = () => deleteTodo(todo.id);
        
        const editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.classList.add('edit');
        editButton.onclick = () => editTodo(todo.id);

        actionsDiv.appendChild(editButton);
        actionsDiv.appendChild(deleteButton);
        
        listItem.appendChild(actionsDiv);
        todoListElement.appendChild(listItem);
    });
}
