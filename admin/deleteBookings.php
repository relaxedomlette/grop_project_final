<?php 

require_once "../db_connection.php";

session_start();

if (!isset($_SESSION["admin"])&&!isset($_SESSION["trainer"])&&!isset($_SESSION
["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
  }
  
  if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/dashboardTrainer.php");
  }
  


$id = $_GET["userid"];

$sql = "SELECT * FROM `bookings` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
if ($row["picture"] != "defaultPic.jpg") {
    unlink("../Images/{$row["picture"]}");
}

$booking_id = $_GET["courseId"];

$delete = "DELETE FROM `bookings` WHERE id = $booking_id";

if(mysqli_query($connection, $delete)){
    header("Location: dashboardAdmin.php");
}else {
    echo "Error";
}

mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
</body>
</html>