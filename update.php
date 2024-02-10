<?php
session_start();
include ('config.php');

$_SESSION["errors"] = array();
if (isset($_POST['edit'])) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];
    $password = $_POST['password'];

    //$passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (strlen($password) < 8) {
        $_SESSION["errors"][] = "Password must be at least 8 characters long !";
    }
    if (preg_match('~[0-9]+~', $firstName)) {
        $_SESSION["errors"][] = "First name can not include numbers !";
    }
    if (preg_match('~[0-9]+~', $lastName)) {
        $_SESSION["errors"][] = "Last name can not include numbers !";
    }

    $justNums = preg_replace("/[^0-9]/", '', $phoneNumber);
    if ((strlen($justNums) != 10)) {
        $_SESSION["errors"][] = "Phone number must be with 10 numbers !";
    }

    $sql = "SELECT * FROM users_with_verification WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num_equal_email = mysqli_num_rows($result);
    if ($num_equal_email > 0){
        $errors[] = "Email already exists!";
    }

    if (count($_SESSION["errors"]) > 0){
        header("Location: crud_index.php");
    }
    else{
        $id = $_SESSION["user"]["id"];
        $sql = "UPDATE users_with_verification SET first_name  = '$firstName', last_name = '$lastName', 
                email = '$email', phone_number = '$justNums', password = '$password' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if (!$result){
            die("Query failed");
        }
        else{
            if($_SESSION["user"]["email"] != $email){
                $_SESSION["user"] = null;
                $sql = "UPDATE users_with_verification SET email_verified  = ''  WHERE id = '$id'";
                mysqli_query($conn, $sql);
                session_destroy();
                header("Location: login.php?edit_mail_msg= Enter your new email, and password if you change it.");
            }
            else{
                header("Location: crud_index.php?update_msg=You have successfully updated the data");
            }

        }
    }
}
