<?php

$con = mysqli_connect("localhost:3308", "root", "", "todo_db");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>