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

    // delete button
    let allDeleteBtns = document.querySelectorAll('.delete-btn');

    for (i = 0; i < allDeleteBtns.length; i++){
        // console.log(allDeleteBtns[0])
        allDeleteBtns[i].addEventListener('click', function(event) {
            let parentElement = event.target.parentNode;
            console.log(parentElement);
            todoList.removeChild(parentElement)
            // console.log(elem);
            console.log('hello');
            saveTasks();
        })
    }

        // delete button
        let allCompleteBtns = document.querySelectorAll('.complete-btn');

        for (i = 0; i < allCompleteBtns.length; i++){
            // console.log(allCompleteBtns[0])
            allCompleteBtns[i].addEventListener('click', function(event) {
                let parentElement = event.target.parentNode;
                console.log(parentElement);
                parentElement.style.setProperty('text-decoration', 'line-through')
                // console.log(elem);
                console.log('hello');
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

