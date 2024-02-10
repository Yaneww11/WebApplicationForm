<?php
session_start();
if (isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User login</title>
    <link rel="stylesheet" href="styles_and_script/login_and_verifystyles.css">
    <link rel="icon" href="/images/logo.png">
</head>
<body>
    <div class="page">
        <form action="login.php" method="post">
            <div class="errors">
                <?php
                if (isset($_GET['delete_msg'])){
                    echo "<div class='alert alert-danger'>" . $_GET['delete_msg'] . "</div>";
                }
                if (isset($_GET['edit_mail_msg'])){
                    echo "<div class='alert alert-success'>" . $_GET['edit_mail_msg'] . "</div>";
                }
                if (isset($_POST['create'])){
                    $email     = $_POST['email'];
                    $password  = $_POST['password'];

                    require_once "config.php";
                    $sql = "SELECT * FROM users_with_verification WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    //make array with values in table (id, fitstname, lastname, email, phone_number, password, email_verified)
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    if ($user){
                        //$verify = password_verify($password, $user["password"]);
                        if ($password == $user["password"]){
                            session_start();
                            $_SESSION["user"] = $user;
                            header("Location: index.php");
                            die();
                        }else{
                            echo "<div class='alert alert-danger'>Password does not match!</div>";
                        }
                    }else{
                        echo "<div class='alert alert-danger'>Email does not match!</div>";
                    }

                }
                ?>
            </div>

            <header>
                <h1>Login Form</h1>
            </header>

            <main>
                <label for="email"><b>Email Address</b> </label>
                <input type="email" name="email" required>

                <label for="password"><b>Password</b> </label>
                <input type="password" name="password" required>

                <div class="register_message"><p>Become a manchester fan: <a href="registration.php">Register Here</a></p></div>
            </main>

            <footer>
                <input type="submit" name="create" value="Login" class="button">
            </footer>
        </form>
    </div>
</body>
</html>