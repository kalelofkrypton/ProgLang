<?php
define("TASK_FILE","tasks.txt");

//Load tasks from file
function loadTasks() {
    return file_exists(TASK_FILE) ? file(TASK_FILE, FILE_IGNORE_NEW_LINES) : [];
}

//Save tasks to file
function saveTasks($tasks) {
    file_put_contents(TASK_FILE, implode("\n", $tasks));
}

//Show Menu
function showMenu() {
    echo "\n=== To-Do List ===\n";
    echo "1. View Tasks\n";
    echo "2. Add Task\n";
    echo "3. Mark Tasks Completed\n";
    echo "4. Clear Completed Tasks\n";
    echo "5. Exit\n";
    echo "Choose an option: ";
}

//Show tasks
function showTasks($tasks) {
    if (empty($tasks)) {
        echo "No tasks.\n";
    } else {
        foreach ($tasks as $index => $tasks) {
            echo "[" . ($index + 1) . "] $tasks\n";
        }
    }
}

//Add task
function addTask(&$tasks) {
    echo "Enter task: ";
    $task = trim(fgets(STDIN));
    if (!empty($task)) {
        $tasks[] = $task;
        saveTasks($tasks);
        echo "Task added.\n";
    }
}

//Mark tasks completed
function markDone(&$tasks) {
    showTasks($tasks);
    echo "Enter task number to mark as completed: ";
    $num = trim(fgets(STDIN))-1;
    if (isset($tasks[$num])) {
        unset($tasks[$num]);
        $tasks = array_values($tasks);
        saveTasks($tasks);
        echo "Task marked as completed.\n";
    } else {
        echo "Invalid task number.\n";
    }
}

//Remove tasks
function removeTasks(&$tasks) {
    showTasks($tasks);
    echo "Enter task number to remove: ";
    $num = trim(fgets(STDIN))-1;
    if (isset($tasks[$num])) {
        unset($tasks[$num]);
        $tasks = array_values($tasks);
        saveTasks($tasks);
        echo "Task removed.\n";
    } else {
        echo "Invalid task number.\n";
    }
}

//Main program
$tasks = loadTasks();
while (True) {
    showMenu();
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case 1:
            showTasks($tasks);
            break;
        case 2:
            addTask($tasks);
            break;
        case 3:
            markDone($tasks);
            break;
        case 4:
            removeTasks($tasks);
            break;
        case 5:
            echo "Goodbye!\n";
            break 2;
        default:
            echo "Invalid option.\n";
    }
}
?>