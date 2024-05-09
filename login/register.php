<?php

session_start();

if (isset($_SESSION["admin"])) {
    header("Location: ./admin/indexAdmin.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ./User/indexUser.php");
}

if (isset($_SESSION["trainer"])) {
    header("Location: ./Trainer/indexTrainer.php");
}

require_once "../db_connection.php";
require_once "file_upload.php";

function cleanInput($var)
{
    $name = trim($var);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    return $name;
}



$error = false;

$firstNameError = $firstName = $secondName = $email = $password = $secondNameError = $emailError = $passwordError = $phoneNumber = $phoneNumberError = $address = $addressError = "";


if (isset($_POST["submit"])) {
    $firstName = ($_POST["firstName"]);
    $secondName = ($_POST["secondName"]);
    $email = ($_POST["email"]);
    $phoneNumber = ($_POST["phoneNumber"]);
    $address = ($_POST["address"]);
    $picture = fileUpload($_FILES["picture"]);
    $password = ($_POST["password"]);


    // validation first name start:
    if (empty($firstName)) {
        $error = true;
        $firstNameError = "Please insert a first name";
    } else if (strlen($firstName) < 3) {
        $error = true;
        $firstNameError = "You first name has to be 3 char long";
    } else if (!preg_match("/^[a-zA-Z\s]+$/", $firstName)) {
        $error = true;
        $firstNameError = "The first Name can only contain letters and spaces";
    }
    // validation first name end

    // validation last name start:
    if (empty($secondName)) {
        $error = true;
        $secondNameError = "Please insert a last name";
    } else if (strlen($secondName) < 3) {
        $error = true;
        $secondNameError = "You last name has to be 3 char long";
    } else if (!preg_match("/^[a-zA-Z\s]+$/", $secondName)) {
        $error = true;
        $secondNameError = "The last Name can only contain letters and spaces";
    }
    // validation last name end

    // validation email start:
    if (empty($email)) {
        $error = true;
        $emailError = "Please insert an email";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Your Email contains not vailavle signs";
    } else {
        $sql = "SELECT email FROM `users` WHERE email = '{$email}'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Email already exists. Please login!";
        }
    }



    // validation email end

    // validation password start:
    if (empty($password)) {
        $error = true;
        $passwordError = "Please insert a password";
    } else if (strlen($password) < 6) {
        $error = true;
        $passwordError = "You password has to be 6 char long";
    }
    // validation password end


    if (!$error) {
        $password = hash("sha256", $password);

        $sqlInsert = "INSERT INTO `users`(`firstName`, `secondName`, `email`, `password`, `address`, `phoneNumber`, `picture`) VALUES ('{$firstName}','{$secondName}','{$email}','{$password}','{$address}','{$phoneNumber}','{$picture[0]}')";

        $result = mysqli_query($connection, $sqlInsert);
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

<body onload="<?php if ($result) {
                    echo 'showPopup()';
                } ?>">

    <div id="successPopup" class="popup">
        <div class="popup-content">
            <div class="popup-bg">
                <img src="../Images/checkmark.png" alt="">
                <p>Success</p>
            </div>
            <div class="popup-text">
                <p>Congratulations, your account<br> has been successfully created</p>
                <a href="../login/login.php" class="continueBtn">Continue</a>
            </div>
        </div>
    </div>
    <div class="logoContainer">
        <a href="../index.php"><img class="logo" src="../Images/logo.png" alt="logo"></a>
    </div>
    <div class="container">
        <div class="registerLogin">
            <h4><a href="login.php">Login</a></h3>
                <h3><a href="register.php">Registration</a>
            </h4>
        </div>
        <h5>Register here:</h5>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="fnlNameInput">
                <div class="fNameInput inputFields">
                    <input class="input" type="text" placeholder="First Name" name="firstName" value="<?= $firstName ?>" required>
                    <p class="errorMessage"><?php echo $firstNameError ?></p>
                </div>
                <div class="lNameInput inputFields">
                    <input class="input" type="text" placeholder="Last Name" name="secondName" value="<?= $secondName ?>" required>
                    <p class="errorMessage"><?php echo $secondNameError ?></p>
                </div>
            </div>
            <div class="emailInput inputFields">
                <input class="input" type="text" placeholder="Email" name="email" value="<?= $email ?>" required>
                <p class="errorMessage"><?php echo $emailError ?></p>
            </div>
            <div class="phoneNumberInput inputFields">
                <input class="input" type="text" placeholder="Phone Number" name="phoneNumber" value="<?= $phoneNumber ?>" required>
                <p class="errorMessage"><?php echo $phoneNumberError ?></p>
            </div>
            <div class="ageInput inputFields">
                <input class="input" type="text" name="address" placeholder="Address" value="<?= $address ?>" required>
                <p class="errorMessage"><?php echo $addressError ?></p>
            </div>
            <div class="imgInput inputFields">
                <input class="input" type="file" name="picture">
            </div>
            <div class="passwordInput inputFields">
                <input class="input" type="password" placeholder="Password" name="password" required>
                <p class="errorMessage"><?php echo $passwordError ?></p>
            </div>
            <div class="submitInput">
                <input class="submitBtn" type="submit" name="submit" value="Register">
            </div>
        </form>
        <div class="divLoginBtn">
            <p>You already have an account? <a class="loginBtn" href="login.php">Login</a></p>
        </div>
    </div>

    <script>
        function showPopup() {
            var popup = document.getElementById("successPopup");
            popup.classList.add("show");

            setTimeout(function() {
                window.location.href = "login.php";
            }, 3000);
        }
    </script>

</body>

</html>