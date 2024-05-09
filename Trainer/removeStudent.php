<?php
session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

require_once "../db_connection.php";

$id = $_GET["courseId"];
$userId = $_GET["userid"];

$delete = "DELETE FROM bookings WHERE bookings.fk_course_id = $id AND bookings.fk_user_id = $userId";

if (mysqli_query($connection, $delete)) {
    // Redirect back to details.php after successful deletion
    header("Location: details.php?id=$id");
    exit(); // Make sure to exit after sending the header
} else {
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