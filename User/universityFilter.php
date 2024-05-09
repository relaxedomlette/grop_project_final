<?php

session_start();


if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION
["user"])) {
    header("Location: ../login/login.php");
}


require_once "../db_connection.php";


$id = $_GET["id"];

$selectID = "SELECT * FROM `courses` WHERE university = '{$id}'";

$result = mysqli_query($connection, $selectID);

$layout = "";

if (mysqli_num_rows($result) == 0) {
    $layout = "No courses found!";
} else {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($rows as $value) {
        $layout .= "<div class='center'>
        <div class='card' style='width: 18rem;'>
        <img src='img/{$value["picture"]}' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>{$value["subject"]}</h5>
          <p class='card-text'>Date:{$value["date"]}</p>
          <p class='card-text'>Duration:{$value["duration"]}</p>
          
          <a href='details.php?id={$value["id"]}' class='btn btn-success'>Details</a>
      </div>
      </div>
        </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?= $layout ?>

</body>
</html>