<?php
    //Connect database
    $hostName = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "user_accounts";
    $conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);

    if (!$conn){
        die("Something went wrong;");
    }
