<?php
session_start();
include ('config.php');

$id = $_SESSION["user"]["id"];
$sql = "DELETE FROM users_with_verification WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (!$result){
    die("DELETED Query Failed");
}
else{
    $_SESSION["user"] = null;
    session_destroy();
    header("Location: login.php?delete_msg= You have deleted your account.");
}

