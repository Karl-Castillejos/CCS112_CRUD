<?php session_start(); 
    require 'connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Task | Edit</title>

    <style>
        body{
            align-items: center;
        }
        .card{
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }
        .card-body {
            background-color: rgb(173, 172, 158);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .mb-3 input {
            margin-bottom: 8px;
            padding: 5px;
            border: 2px solid blanchedalmond;
            border-radius: 4px;
        }
    </style>

  </head>
  <body>
    
        <div class="row">
            <div class="col-md-12">
                <div class="card">   


                <div class="card-header">
                    <h4>Update Task Details
                        <a href="index.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php 
                        if(isset($_GET['id'])){
                            $tasknumber = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM tasktable WHERE tasknumber = '$tasknumber' ";
                            $query_run = mysqli_query($con, $query);


                            if(mysqli_num_rows($query_run) > 0){
                                $task = mysqli_fetch_array($query_run);
                                ?>
                                <form action="process.php" method="POST">
                                    <input type="hidden" name="tasknumber" value="<?=$tasknumber?>">
                                
                                    <div class="mb-3">
                                        <label for="tasktitle">Task Title:</label><br>
                                        <input type="text" name="tasktitle" value="<?=$task['tasktitle'];?>" class="addData" required><br> 
                                        <label for="dscription">Description:</label><br>
                                        <input type="text" name="dscription" value="<?=$task['taskdescription'];?>" class="addData" required><br>
                                        <label for="duedate">Due Date:</label><br>
                                        <input type="date" id="duedate" name="duedate" value="<?=$task['duedate'];?>" class="addData" required>

                                    </div>
                        
                                    <div class="mb-3">
                                        <button type="submit" name="updatetask" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                                <?php

                            }else{
                                echo "<h5> No record found </h5>";
                            }

                        }
                    ?>           
                </div>

                </div>
            </div>
        </div>



        



       



    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   
  </body>
</html>
