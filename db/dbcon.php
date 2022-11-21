<?php

//connect to the database
$con = mysqli_connect("localhost", "root", "", "task_manager");

//check the connection
if(!$con){
  echo 'Connection Failed' . mysqli_connect_error();
}
