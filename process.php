<?php
session_start();
require 'connect.php';

if(isset($_POST['addtask'])){


    $tasktitle = mysqli_real_escape_string($con, $_POST['tasktitle']);
    $description = mysqli_real_escape_string($con, $_POST['dscription']);
    $duedate = mysqli_real_escape_string($con, $_POST['duedate']);

    // Check for duplicate entry
    $check_query = "SELECT * FROM tasktable WHERE tasktitle='$tasktitle'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0){
        // Duplicate found
        $_SESSION['message'] = "This task already exists.";
        header("Location: index.php");
        exit(0);
    } else {
        // No duplicate, proceed with insertion
        $query = "INSERT INTO tasktable (tasktitle, taskdescription, duedate)
                  VALUES ('$tasktitle', '$description', '$duedate' )";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['message'] = "Recorded Successfully";
        } else {
            $_SESSION['message'] = "Unsuccessful";
        }
        
        header("Location: index.php");
        exit(0);
    }
}


if(isset($_GET['searchTask'])){
$filtervalues = $_GET['searchTask'];
$query = "SELECT * FROM tasktable WHERE CONCAT(tasktitle, taskdescription, duedate) LIKE'%$filtervalues%' ";
$query_run = mysqli_query($con, $query);

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
            <td colspan="6">No Record Found</td>
        </tr>
    <?php
}
}


if(isset($_POST['deletetask'])){
    $tasknumber = mysqli_real_escape_string($con, $_POST['deletetask']);

    $query = "DELETE FROM tasktable WHERE tasknumber = '$tasknumber' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }else{
        $_SESSION['message'] = "Unsuccessful";
        header("Location: index.php");
        exit(0);
    }
}


if(isset($_POST['updatetask'])){
    $tasknumber = mysqli_real_escape_string($con, $_POST['tasknumber']);

    $tasktitle = mysqli_real_escape_string($con, $_POST['tasktitle']);
    $description = mysqli_real_escape_string($con, $_POST['dscription']);
    $duedate = mysqli_real_escape_string($con, $_POST['duedate']);

    // Check for duplicate entry with different Task
    $check_query = "SELECT * FROM tasktable WHERE tasktitle='$tasktitle' AND taskdescription='$description' AND tasknumber != '$taskID'";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0){
        // Duplicate found
        $_SESSION['message'] = "A task with the same name already exists.";
        header("Location: taskedit.php?id=$tasknumber");
        exit(0);
    } else {
        // No duplicate, proceed with update
        $query = "UPDATE tasktable SET tasktitle='$tasktitle', taskdescription='$description', duedate='$duedate'
                  WHERE tasknumber = '$tasknumber'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['message'] = "Details Updated Successfully";
        } else {
            $_SESSION['message'] = "Update Unsuccessful";
        }

        header("Location: index.php");
        exit(0);
    }
}


if(isset($_POST['deletetask'])){
    $tasknumber = mysqli_real_escape_string($con, $_POST['deletetask']);

    $query = "DELETE FROM tasktable WHERE tasknumber = '$tasknumber' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }else{
        $_SESSION['message'] = "Unsuccessful";
        header("Location: index.php");
        exit(0);
    }
}



?>