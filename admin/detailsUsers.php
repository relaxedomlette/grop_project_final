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


require_once "../db_connection.php";

if ($_GET["id"]) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM `users` WHERE id = {$id}";
  $result = mysqli_query($connection, $sql);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
  }
}

$user_id = $_SESSION["admin"];
foreach ($rows as $row)
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/detailsUser.css">
</head>

<body>
  <div>
    <img class="bkgr" src="../Images/courses-banner.jpg" alt="">
    <div class="infoCard">
      <div class="nameCard">
        <p><?= $row["firstName"] . ' ' . $row["secondName"] ?></p>
      </div>
      <div class="infoBox d-flex justify-content-between">
        <div>
          <p>Adress:</p>
          <p>Email:</p>
          <p>Phone Number:</p>
          <p>Status:</p>
        </div>
        <div>
          <p><?= $row["address"] ?></p>
          <p><?= $row["email"] ?></p>
          <p><?= $row["phoneNumber"] ?></p>
          <p><?= $row["Status"] ?></p>
          <a href='updateUser.php?id=<?= $row["id"] ?>' class='updateUserBtn'>Update User</a>
        </div>
      </div>
      <div class="imgCard">
        <img src=../Images/<?= $row["picture"] ?> alt='image'>
      </div>
      <div class="detailsBtn">
        <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
          <a href="dashboardAdmin.php">Go Back</a>
        </div>
      </div>
    </div>


</body>

</html>