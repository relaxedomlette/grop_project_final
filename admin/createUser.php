<?php

session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
  header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
  header("Location: ../User/dashboardUser.php");
}

if (isset($_SESSION["trainer"])) {
  header("Location: ../Trainer/dashboardTrainer.php");
}


require "../db_connection.php";
require "../login/file_upload.php";

function cleanInput($var)
{
  $name = trim($var);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);

  return $name;
}



$error = false;

$firstNameError = $firstName = $secondName = $email = $password = $secondNameError = $emailError = $passwordError = $phoneNumber = $phoneNumberError = $address = $addressError = $status = "";


if (isset($_POST["submit"])) {
  $firstName = $_POST["firstName"];
  $secondName = $_POST["secondName"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $phoneNumber = $_POST["phoneNumber"];
  $status = $_POST["status"];
  $picture = fileUpload($_FILES["picture"]);
  $password = $_POST["password"];


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

    if ($result) {
      $firstName = $secondName = $email = $phoneNumber = $address = $password = "";
      header("refresh: 3; url=dashboardAdmin.php");
    } else {
      echo "Error";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create new User</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/CRUD.css">
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
        <p>Congratulations, a user<br> has been successfully created</p>
        <a href="../Trainer/dashboardTrainer.php" class="continueBtn">Continue</a>
      </div>
    </div>
  </div>
  <div class="containerCRUD container mt-5">
    <div class="crudHeader">
      <h3 class="mb-4">Create new user:</h3>
    </div>
    <form id="multiStepForm" method="post" enctype="multipart/form-data">
      <!-- Step 1 -->
      <div class="step active">
        <div class="progress mb-3" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%; background-color: #099268; border-radius: 20px;"></div>
        </div>
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
        <div class="passwordInput inputFields">
          <input class="input" type="password" placeholder="Password" name="password" required>
          <p class="errorMessage"><?php echo $passwordError ?></p>
        </div>
        <label for="status">Status:</label>
        <select name="status" required>
          <option value="user <?= $status  == "user" ? 'selected' : '' ?>">user</option>
          <option value="admin <?= $status  == "admin" ? 'selected' : '' ?>">admin</option>
          <option value="trainer <?= $status  == "trainer" ? 'selected' : '' ?>">trainer</option>
        </select>
        <button type="button" class="submitBtn" onclick="nextStep()">Next</button>
        <a class="btn submitBtn" href="dashboardAdmin.php">Go Back</a>

      </div>

      <!-- Step 2 -->
      <div class="step">
        <div class="progress mb-3" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%; background-color: #099268; border-radius: 20px;"></div>
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
        <div class="d-flex justify-content-between">
          <button type="button" class="submitBtn" onclick="prevStep()" style="width: 200px; background-color: #38D9A9;">Back</button>
          <button type="submit" class="submitBtn" value="submit" name="submit" style="width: 200px;">Submit</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    function nextStep() {
      const currentStep = document.querySelector('.step.active');
      const nextStep = currentStep.nextElementSibling;

      if (nextStep) {
        currentStep.classList.remove('active');
        nextStep.classList.add('active');
      }
    }

    function prevStep() {
      const currentStep = document.querySelector('.step.active');
      const prevStep = currentStep.previousElementSibling;

      if (prevStep) {
        currentStep.classList.remove('active');
        prevStep.classList.add('active');
      }
    }
  </script>
    <script>
    function showPopup() {
      var popup = document.getElementById("successPopup");
      popup.classList.add("show");

      setTimeout(function() {
        window.location.href = "../Trainer/dashboardTrainer.php";
      }, 3000);
    }
  </script>

</body>

</html>