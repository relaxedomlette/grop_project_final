<?php
session_start();

if (isset($_SESSION["admin"])) {
    header("Location: ../admin/dashboardAdmin.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/dashboardTrainer.php");
}

require_once "../db_connection.php";

function cleanInput($var)
{
    $name = trim($var);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    return $name;
}

$error = false;
$email = $password = $error_password = $error_email = "";

if (isset($_POST["submit"])) {
    $email = cleanInput($_POST["email"]);
    $password = cleanInput($_POST["password"]);

    if (empty($email)) {
        $error = true;
        $error_email = "Please insert your email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $error_email = "Please insert a valid email";
    }

    if (empty($password)) {
        $error = true;
        $error_password = "Please insert your password";
    }

    if (!$error) {
        $password = hash("sha256", $password);

        $sql = "SELECT * FROM `users` WHERE email = '{$email}' and `password` = '{$password}'";
        $result = mysqli_query($connection, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($count == 1) {
            $_SESSION["user_id"] = $row["id"];

            if ($row["Status"] == "admin") {
                $_SESSION["admin"] = $row["id"];
                header("Location: ../admin/dashboardAdmin.php");
            } else if ($row["Status"] == "user") {
                $_SESSION["user"] = $row["id"];
                header("Location: ../User/dashboardUser.php");
            } else {
                $_SESSION["trainer"] = $row["id"];
                header("Location: ../Trainer/dashboardTrainer.php");
            }
        } else {
            $error_password = "Your email or password is not correct!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/loginRegister.css">
</head>

<body>
    <div class="logoContainer">
        <a href="../index.php"><img class="logo" src="../Images/logo.png" alt="logo"></a>
    </div>
    <div class="container">
        <div class="loginRegister">
            <h3><a href="login.php">Login</a></h3>
            <h4><a href="register.php">Registration</a></h4>
        </div>
        <h5>Login here:</h5>
        <form action="" method="post">

            <div class="emailInput inputFields">
                <input class="input" type="text" placeholder="Email" name="email" required>
                <p class="errorMessage"><?php echo $error_email ?></p>
            </div>

            <div class="passwordInput inputFields">
                <input class="input" type="password" placeholder="Password" name="password" required>
                <p class="errorMessage"><?php echo $error_password ?></p>
            </div>

            <div class="submitInput">
                <input class="submitBtn" type="submit" name="submit" value="Login">
            </div>
        </form>
        <div class="divLoginBtn">
            <p>Your dont have an account? <a class="loginBtn" href="register.php">Register</a></p>
        </div>
    </div>
</body>

</html>