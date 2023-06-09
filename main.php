<h2>Todo App</h2>

<input type="text" name="enter-task" id="enterTask">
<input type="submit" value="Enter Task" id="taskBtn">

<ul class="todo-list">
</ul>

<script>    
    let enterTask = document.querySelector('#enterTask');
    let taskBtn = document.querySelector('#taskBtn');
    let todoList = document.querySelector('.todo-list');

    // gets value of input
    taskBtn.addEventListener('click', addItemsToList);

    // problem: when reloading, previous items don't work
    if(localStorage.getItem('tasks')) {
        todoList.innerHTML = localStorage.getItem('tasks');
    }
    
    // adds item to list
    function addItemsToList() {
        console.log(enterTask.value);
        var newItem = document.createElement('li');
        var newItemText = document.createTextNode(enterTask.value);

        newItem.appendChild(newItemText);

        // create a delete button
        var deleteButton = document.createElement('button');
        deleteButton.classList.add('delete-btn');
        deleteButton.innerText = 'Delete';
        deleteButton.addEventListener('click', function() {
            todoList.removeChild(newItem)
            saveTasks();
        })
        newItem.appendChild(deleteButton);

        // create a complete button
        var completeButton = document.createElement('button');
        completeButton.innerText = 'Complete';
        completeButton.classList.add('complete-btn');
        completeButton.addEventListener('click', function() {
            newItem.style.setProperty('text-decoration', 'line-through')
            saveTasks();
        })
        newItem.appendChild(completeButton)

        // adds new item to list
        todoList.appendChild(newItem);

        enterTask.value = '';

        saveTasks();

    }

        // all btns
        let allBtns = document.querySelectorAll('button');

        for (i = 0; i < allBtns.length; i++){
            console.log(allBtns[i])
            allBtns[i].addEventListener('click', function(event) {
                // console.log(event.target.textContent)
                let parentElement = event.target.parentNode;

                if(event.target.textContent.includes('Delete')){
                    todoList.removeChild(parentElement)
                    // saveTasks();
                }

                if(event.target.textContent.includes('Complete')) {
                    parentElement.style.setProperty('text-decoration', 'line-through')
                }
                saveTasks();
            })
        }



    function saveTasks() {
        localStorage.setItem('tasks', todoList.innerHTML);
    }

    enterTask.addEventListener('keypress', function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            taskBtn.click();
        }
    })


</script>

