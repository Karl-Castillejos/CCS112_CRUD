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