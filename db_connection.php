<?php

$user_name = "root";
$host_name = "127.0.0.1";
$password = "";
$database = "tutoring_service";

$connection = mysqli_connect($host_name, $user_name, $password, $database);

if(!$connection){
    die("connection failed!");
}