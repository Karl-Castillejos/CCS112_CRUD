<?php 
    // Start the session to use session variables
    session_start();
    
    // Include the connection file to connect to the database
    require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>

    <!-- Link to Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="istyle.css">
</head>
<body>
    <header class="header">
        <!-- Navbar section with links to dashboard and add task sections -->
        <nav class="navbar">
            <a href="#tasks">Dashboard</a>
            <a href="#addSection">Add Task</a>
        </nav>
    </header>

    <div class="add">
        <!-- Section for displaying tasks -->
        <section id="tasks">
            <div class="tasks">
                <h1>Tasks To Do
                    <!-- Button to navigate to the add task form -->
                    <a href="#addSection" class="btn float-end">Add Task</a>
                </h1>
                
                <!-- Form to search for a task -->
                <form action="" method="GET">
                    <div class="searchInput">
                        <!-- Search field, retains the value on page reload -->
                        <input type="text" name="searchTask" value="<?php if(isset($_GET['searchTask'])){echo $_GET['searchTask'];}?>" class="searchTask" placeholder="Search task" required>
                        <button name="submit" class="btn btn-primary">Search</button>
                    </div>
                    <div class="result">
                        <table  class="table table-bordered">
                            
                            <?php

                            if(isset($_GET['searchTask'])){
                                $filtervalues = $_GET['searchTask'];
                                $query = "SELECT * FROM tasktable WHERE CONCAT(tasktitle, taskdescription, duedate) LIKE'%$filtervalues%' ";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    foreach($query_run as $task){
                                        ?>
                                        <tr>
                                            <th>Task Number</th>
                                            <th>Task Title</th>
                                            <th>Description</th>
                                            <th>Due Date</th>
                                        </tr>
                                        <tr>
                                            <td><?= $task['tasknumber']; ?></td>
                                            <td><?= $task['tasktitle']; ?></td>
                                            <td><?= $task['taskdescription']; ?></td>
                                            <td><?= $task['duedate']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                
                                }else{
                                    ?>
                                        <tr>
                                            <td colspan="6">No Record Found</td>
                                        </tr>
                                    <?php
                                }
                            } 
                            ?>

                        </table>
                    </div>     


                </form>

                <!-- Table for displaying tasks -->
                <table class="table">
                    <tr>
                        <th>Task Number</th>
                        <th>Task Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                    <!-- PHP script to fetch tasks from the database -->
                    <?php
                    // Query to select all tasks from the tasktable
                    $query = "SELECT * FROM tasktable";
                    $query_run = mysqli_query($con, $query);

                    // Check if any tasks exist in the database
                    if(mysqli_num_rows($query_run) > 0){
                        // Loop through each task and display it in a table row
                        foreach($query_run as $task){
                            ?>      
                            <tr>
                                <td><?= $task['tasknumber']; ?></td>
                                <td><?= $task['tasktitle']; ?></td>
                                <td><?= $task['taskdescription']; ?></td>
                                <td><?= $task['duedate']; ?></td>
                                <td>
                                    <!-- Edit button links to taskedit.php with the task's id -->
                                    <a href="taskedit.php?id=<?= $task['tasknumber']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    
                                    <!-- Delete button, sends POST request to process.php to delete the task -->
                                    <form action="process.php" method="POST" class="d-inline">
                                        <button type="submit" name="deletetask" value="<?= $task['tasknumber']; ?>" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }

                    }else{
                        // If no records found, display this message
                        ?>
                            <tr>
                                <td colspan="2">No Record Found</td>
                            </tr>
                        <?php
                    }
                    ?>

                </table>
            </div>

        </section>
        
        <!-- Section for adding a new task -->
        <section id="addSection">
            <div class="addSection">
                <form action="process.php" method="POST">
                    <h1>Add Task</h1>
                    <div class="addClass">
                        <!-- Input for task title -->
                        <label for="tasktitle">Task Title:</label><br>
                        <input type="text" id="tasktitle" name="tasktitle" class="addData" required><br>
                        
                        <!-- Input for task description -->
                        <label for="dscription">Description:</label><br>
                        <input type="text" id="dscription" name="dscription" class="addData" required><br>
                        
                        <!-- Input for due date -->
                        <label for="duedate">Due Date:</label><br>
                        <input type="date" id="duedate" name="duedate" class="addData" required>
                        
                        <!-- Button to submit the new task -->
                        <button type="submit" name="addtask" class="btnAdd">Add Task</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
