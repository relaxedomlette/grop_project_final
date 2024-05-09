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
    $sql = "SELECT * FROM courses WHERE id = {$id}";
    $result = mysqli_query($connection, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
    }
}
//     } else {
//         // header("location: error.php");
//     }
//     // mysqli_close($connection);
// } else {
//     // header("location: error.php");
// }


if (isset($_POST["bookings"])) {
    $user_id = $_SESSION["user"];
    $course_id = $_GET["id"];

    // Überprüfen, ob der Benutzer bereits für diesen Kurs angemeldet ist
    $checkBookingSql = "SELECT * FROM `bookings` WHERE `fk_user_id` = '{$user_id}' AND `fk_course_id` = '{$course_id}'";
    $checkBookingResult = mysqli_query($connection, $checkBookingSql);

    $countCapacity = "UPDATE `courses` SET `capacity`= capacity-1 WHERE id =  {$course_id}";
    $checkCapacityResult = mysqli_query($connection, $countCapacity);


    if (mysqli_num_rows($checkBookingResult) > 0) {
        echo "You already subscribed to this course!";
    } else {
        // Wenn der Benutzer nicht angemeldet ist, die Buchung durchführen
        $booking_date = date("Y-m-d");
        $bookingSql = "INSERT INTO `bookings`(`fk_user_id`, `fk_course_id`, `date`) VALUES ('{$user_id}','{$course_id}',CURDATE())";

        if (mysqli_query($connection, $bookingSql)) {
            echo "Course has been booked. Gratulation!";
        } else {
            echo "Something went wrong. Please try again!";
        }
    }
}

$course_id = $_GET["id"];

$user_id = $_SESSION["admin"];
foreach ($rows as $row) {
    $layout = '
    <div class="detailContainer">
        <div>
            <h1 class="">' . $row["subject"] . '</h1>
        </div>
        <div class="topCard">
            <div class="leftCard">
                <ul style="">
                    <li>
                        <a href="teacherDetail.php?email=' . $row["email"] . '">Teacher: <strong>' . $row["teacher"] . '</strong></a>
                    </li>
                    <li>
                        <p>University: <strong>' . $row["university"] . '</strong></p>
                    </li>
                   
                    <li>
                    <p>Capacity left: <strong>' . $row["capacity"] . '</strong></p>
                </li>
                <li>
                <p>Availability: <strong>' . $row["availability"] . '</strong></p>
            </li>
                </ul>
            </div>
            <img src=../Images/' . $row["picture"] . ' class="" alt="...">
        </div>
        <div class="infoBox">
            <div class="d-flex infoContainer">
                <div class="imgCard">
                    <img src="../Images/flag.png" alt="">
                </div>
                <div>
                    <p>RoomNumb: <strong>' . $row["roomNumb"] . '</strong></p>
                    <p>Language: <strong>' . $row["language"] . '</strong></p>
                </div>
            </div>
            <div class="d-flex infoContainer">
                <div class="imgCard">
                    <img src="../Images/calendar.png" alt="">
                </div>
                <div>
                    <p>Start date: <strong>' . $row["date"] . '</strong></p>
                    <p>End date: <strong>' . $row["end_date"] . '</strong></p>
                </div>
            </div>
        </div>
    <div class="detailsBtn">
        <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
            <a href="dashboardAdmin.php">Go Back</a>
        </div>
        <div class="btnDetails" style="background-color: orange; color: #fff;">
                    <a href="updateCourses.php?id=' . $course_id .'">Update Course</a>
                </div>
        <div class="btnDetails" style="background-color: red; color: #fff;">
            <a href="deleteCourses.php?delete_id=' . $row["id"] . '">Delete</a>
        </div>
    </div>
    </div>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/details.css">
</head>

<body>
    <div>
        <img class="bkgr" src="../Images/courses-banner.jpg" alt="">
        <div class="detail">
            <div>

                <?= $layout ?>

            </div>
        </div>
    </div>

</body>

</html>