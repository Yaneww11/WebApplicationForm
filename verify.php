<?php
include ('config.php');
include ('mail.php');

session_start();
if (!isset($_SESSION["user"])){
    header("Location: login.php");
}
$_SESSION['registered'] = false;
function check_verified()
{
    $id = $_SESSION['user']['id'];
    $sql = "select * from users_with_verification where id = '$id' limit 1";
    require "config.php";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row['email'] == $row['email_verified']){
        return True;
    }
    return False;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify email</title>
    <link rel="stylesheet" href="styles_and_script/login_and_verifystyles.css">
    <link rel="icon" href="/images/logo.png">
</head>
<body>
<div class="page">
    <form action="verify.php" method="post">
        <div class="errors">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET" && !check_verified()){
                $code = rand(10000,99999);
                $expires = (time() + (60*3));
                $email = $_SESSION['user']['email'];

                $sql = " INSERT INTO verify (code, expires, email) values (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt){
                    mysqli_stmt_bind_param($stmt, "iis", $code, $expires, $email);
                    mysqli_stmt_execute($stmt);
                }else{
                    die("Something went wrong;");
                }

                $message = "Your code is " . $code;
                $subject = "Email verification";
                $recipient = $email;
                send_mail($recipient,$subject,$message);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST"){

                if (!check_verified()){
                    $email = $_SESSION['user']['email'];
                    $code = $_POST['code'];
                    $sql = "SELECT * FROM verify WHERE code = '$code' && email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    if (is_array($row)){
                        $time = time();
                        if ($row['expires'] > $time){
                            $email = $row['email'];
                            $id = $_SESSION['user']['id'];
                            $sql = "UPDATE users_with_verification set email_verified = '$email' WHERE id = '$id' limit 1";
                            mysqli_query($conn, $sql);
                            $_SESSION['registered'] = true;
                            echo "<div class='alert alert-success'>You verified your email successfully</div>";
                        }
                        else{
                            echo "<div class='alert alert-danger'>Code expired. Refresh page for a new code.</div>";
                        }
                    }
                    else{
                        echo "<div class='alert alert-danger'>Wrong code. Refresh page for a new code.</div>";
                    }

                }
                else{
                    echo "<div class='alert alert-danger'>You are verified and can go back to the site</div>";
                }
            }
            ?>
        </div>

        <header>
            <h1>Verification email</h1>
        </header>

        <main>
            <p>We sent verification code to email  - <?=$_SESSION["user"]['email']?></p>
            <input type="text" name="code" placeholder="Enter your code here" required>
        </main>

        <footer>
            <input type="submit" value="Verify" class="button">
            <a href="index.php">Back to site</a>
        </footer>
    </form>
</div>
</body>
</html>
