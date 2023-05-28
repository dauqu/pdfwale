<!DOCTYPE html>
<html>
<head>
  <title>IndexedDB CRUD App</title>
</head>
<body>
  <h1>IndexedDB CRUD App</h1>

  <form id="task-form">
    <input type="text" id="task-input" placeholder="Enter task">
    <button type="submit">Add Task</button>
  </form>

  <ul id="task-list"></ul>

  <script>
    // Open the IndexedDB database
    const request = indexedDB.open('tasksDB', 1);
    let db;

    request.onerror = function(event) {
      console.log('Database error:', event.target.errorCode);
    };

    request.onupgradeneeded = function(event) {
      db = event.target.result;

      // Create an object store (similar to a table in a traditional database)
      const objectStore = db.createObjectStore('tasks', { keyPath: 'id', autoIncrement: true });

      // Create an index on the 'task' property for searching and sorting
      objectStore.createIndex('task', 'task', { unique: false });
    };

    request.onsuccess = function(event) {
      db = event.target.result;
      displayTasks();
    };

    // Add a new task
    const taskForm = document.getElementById('task-form');

    taskForm.addEventListener('submit', function(event) {
      event.preventDefault();

      const taskInput = document.getElementById('task-input');
      const task = taskInput.value.trim();

      if (task !== '') {
        const transaction = db.transaction(['tasks'], 'readwrite');
        const objectStore = transaction.objectStore('tasks');
        const request = objectStore.add({ task: task });

        request.onsuccess = function() {
          taskInput.value = '';
          displayTasks();
        };

        transaction.oncomplete = function() {
          console.log('Task added to the database.');
        };

        transaction.onerror = function(event) {
          console.log('Transaction error:', event.target.error);
        };
      }
    });

    // Display all tasks
    function displayTasks() {
      const taskList = document.getElementById('task-list');
      taskList.innerHTML = '';

      const objectStore = db.transaction('tasks').objectStore('tasks');

      objectStore.openCursor().onsuccess = function(event) {
        const cursor = event.target.result;

        if (cursor) {
          const taskItem = document.createElement('li');
          taskItem.textContent = cursor.value.task;

          const deleteButton = document.createElement('button');
          deleteButton.textContent = 'Delete';
          deleteButton.dataset.taskId = cursor.value.id;
          deleteButton.addEventListener('click', deleteTask);

          taskItem.appendChild(deleteButton);
          taskList.appendChild(taskItem);

          cursor.continue();
        }
      };
    }

    // Delete a task
    function deleteTask(event) {
      const taskId = Number(event.target.dataset.taskId);

      const transaction = db.transaction(['tasks'], 'readwrite');
      const objectStore = transaction.objectStore('tasks');
      const request = objectStore.delete(taskId);

      transaction.oncomplete = function() {
        console.log('Task deleted from the database.');
        displayTasks();
      };

      request.onerror = function(event) {
        console.log('Delete error:', event.target.error);
      };
    }
  </script>
</body>
</html>
