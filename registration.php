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
    <title>User Registration</title>
    <link rel="stylesheet" href="styles_and_script/registration_styles.css">
    <link rel="icon" href="/images/logo.png">
</head>
<body>
    <div class="page">
        <form action="registration.php" method="post">
            <div class="errors">
                <?php
                if (isset($_POST['create'])){
                    $firstName       = $_POST['firstname'];
                    $lastName        = $_POST['lastname'];
                    $email           = $_POST['email'];
                    $phoneNumber     = $_POST['phone_number'];
                    $password        = $_POST['password'];

                    //$passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $errors = array();

                    if (strlen($password) < 8){
                        $errors[] = "Password must be at least 8 characters long !";
                    }
                    if (preg_match('~[0-9]+~', $firstName)) {
                        $errors[] = "First name can not include numbers !";
                    }
                    if (preg_match('~[0-9]+~', $lastName)) {
                        $errors[] = "Last name can not include numbers !";
                    }

                    $justNums = preg_replace("/[^0-9]/", '', $phoneNumber);
                    if ((strlen($justNums) != 10)) {
                        $errors[] = "Phone number must be with 10 numbers !";
                    }

                    require_once "config.php";
                    $sql = "SELECT * FROM users_with_verification WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $num_equal_email = mysqli_num_rows($result);
                    if ($num_equal_email > 0){
                        $errors[] = "Email already exists!";
                    }

                    if (count($errors) > 0){
                        foreach ($errors as $error){
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    }
                    else{
                        $sql = "INSERT INTO users_with_verification (first_name, last_name, email, phone_number, password) VALUES ( ?, ?, ?, ?, ? )";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                        if ($prepareStmt){
                            mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $email, $justNums, $password);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>You are registered successfully</div>";
                        }else{
                            die("Something went wrong;");
                        }

                    }
                }
                ?>
            </div>

            <header>
                <p><i>Fill up the form with the correct values</i></p>
                <h1>Registration Form</h1>

            </header>

            <main>
                <label for="firstname"><b>First Name</b> </label>
                <input type="text" name="firstname" required>

                <label for="lastname"><b>Last Name</b> </label>
                <input type="text" name="lastname" required>

                <label for="email"><b>Email Address</b> </label>
                <input type="email" name="email" required>

                <label for="phone_number"><b>Phone Number</b> </label>
                <input type="text" name="phone_number" placeholder="088-777-6666" required>

                <label for="password"><b>Password</b> </label>
                <input type="password" name="password" required>

                <div class="login_message"><p>Registered yet: <a href="login.php">Login Here</a></p></div>
            </main>

            <footer>
                <input type="submit" name="create" value="Register" class="button">
            </footer>
        </form>
    </div>
</body>
</html>