<?php
include ('config.php');
session_start();

if (!isset($_SESSION["user"])){
    header("Location: login.php");
}

$id = $_SESSION["user"]["id"];

$query = "SELECT * FROM users_with_verification WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if (!$result){
    die("Query Failed");
}
else{
    $row = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Page</title>
    <link rel="stylesheet" href="styles_and_script/crud_styles.css">
    <link rel="stylesheet" href="styles_and_script/modal_styles.css">
    <link rel="icon" href="/images/logo.png">
</head>
<body>
    <header>
        <div class="arrow"><a href="index.php">&#8656;</a></div>
        <h1>CRUD APPLICATION</h1>
    </header>

    <main>
        <div class="box1">
            <h2>Hi,  <?php echo  $row['first_name'] . " you can see your data in this table. If you want to change something use the buttons."?></h2>
            <div class="navButtons">
                <button class="button" id="updateBtn">Edit data</button>
                <button class="button" id="deleteBtn"><a href="delete.php">Delete data</a></button>
            </div>
            <div id="myModal" class="modal">
                    <form action="update.php" method="post">
                        <span class="close">&times;</span>
                        <header>
                            <h1>Edit data</h1>
                        </header>
                        <div class="erorrs">

                        </div>
                        <main>
                            <label for="firstname"><b>First Name</b> </label>
                            <input type="text" name="firstname" value="<?php echo $row['first_name']?>" required>

                            <label for="lastname"><b>Last Name</b> </label>
                            <input type="text" name="lastname" value="<?php echo $row['last_name']?>" required>

                            <label for="email"><b>Email Address</b> </label>
                            <input type="email" name="email" value="<?php echo $row['email']?>" required>

                            <label for="phone_number"><b>Phone Number</b> </label>
                            <input type="text" name="phone_number" value="<?php echo $row['phone_number']?>" required>

                            <label for="password"><b>Password</b> </label>
                            <input type="text" name="password" value="<?php echo $row['password']?>" required>

                        </main>

                        <footer>
                            <input type="submit" name="edit" value="Save changes" class="button">
                        </footer>
                    </form>
                </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Password</th>
                    <th>Email verification</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $current_email = $_SESSION["user"]['email'];
                $sql = "SELECT * FROM users_with_verification WHERE email = '$current_email'";
                $result = mysqli_query($conn, $sql);

                if (!$result){
                    die("Query Failed".mysqli_error());
                }
                else{
                    /*if we have more than one rows
                     * while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        ?>

                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['first_name']?></td>
                            <td><?php echo $row['last_name']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['phone_number']?></td>
                            <td><?php echo $row['password']?></td>
                            <td><?php echo $row['email_verified']?></td>
                        </tr>
                        <?php

                        }
                ?>
                     *
                     */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        ?>

                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['first_name']?></td>
                            <td><?php echo $row['last_name']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['phone_number']?></td>
                            <td><?php echo $row['password']?></td>
                            <td><?php echo $row['email_verified']?></td>
                        </tr>
                        <?php
                }
                ?>
            </tbody>
        </table>
    </main>

    <footer>
        <?php
        if (isset($_GET['update_msg'])){
            echo "<div class='alert alert-success'>" . $_GET['update_msg'] . "</div>";
        }
        if (!empty($_SESSION["errors"])){
            foreach ($_SESSION["errors"] as $error){
                echo "<div class='alert alert-danger'>$error</div>";
                $_SESSION["errors"] = array();
            }
        }
        ?>
    </footer>

    <script src="styles_and_script/modal.js"></script>
</body>
</html>