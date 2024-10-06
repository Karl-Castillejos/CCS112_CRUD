<?php 
    session_start();
    require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="istyle.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="#tasks">Dashboard</a>
            <a href="#addSection">Add Task</a>
        </nav>
    </header>

    <div class="add">
        <section id="tasks">
            <div class="tasks">
                <h1>Tasks To Do
                    <a href="#addSection" class="btn float-end">Add Task</a>
                </h1>
                <form action="" method="GET">
                    <div class="searchInput">
                        <input type="text" name="searchTask" value="<?php if(isset($_GET['searchTask'])){echo $_GET['searchTask'];}?>" class="searchTask" placeholder="Search task" required>
                        <button name="submit" class="btn btn-primary">Search</button>
                    </div>
                    <div class="result">
                        <table  class="table table-bordered">
                            
                            <!-- Displaying the table -->
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
                <table  class="table">
                    <tr>
                        <th>Task Number</th>
                        <th>Task Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                    <!-- Displaying the table -->
                    <?php

                    $query = "SELECT * FROM tasktable";
                    $query_run = mysqli_query($con,$query);

                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $task){
                            ?>      
                            <tr>
                                <td><?= $task['tasknumber']; ?></td>
                                <td><?= $task['tasktitle']; ?></td>
                                <td><?= $task['taskdescription']; ?></td>
                                <td><?= $task['duedate']; ?></td>
                                <td>
                                    <a href="taskedit.php?id=<?= $task['tasknumber']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <form action="process.php" method="POST" class="d-inline">
                                        <button type="submit" name="deletetask" value="<?= $task['tasknumber'];?>" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }

                    }else{
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
        <section id="addSection"  > 
            <div class="addSection">
                <form action="process.php" method="POST">
                    <h1>Add Task</h1>
                    <div class="addClass">
                        <label for="tasktitle">Task Title:</label><br>
                        <input type="text" id="tasktitle" name="tasktitle" class="addData" required><br>
                        <label for="dscription">Description:</label><br>
                        <input type="text" id="dscription" name="dscription" class="addData" required><br>
                        <label for="duedate">Due Date:</label><br>
                        <input type="date" id="duedate" name="duedate" class="addData" required>
                        <button type="submit" name="addtask" class="btnAdd">Add Task</button>
                    </div>
                </form>
            </div>
        </section>
    </div>


</body>
</html>