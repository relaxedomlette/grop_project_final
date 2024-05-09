<?php
session_start();

require "db_connection.php";


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

// if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
//     header("Location: login.php");
// }

if (isset($_SESSION["user"])) {
    $sqlUser = "SELECT * FROM `users` WHERE id = {$_SESSION["user"]}";
    $runSqlUser = mysqli_query($connection, $sqlUser);
    $rowsUser = mysqli_fetch_assoc($runSqlUser);
    // // adoption start
    if (isset($_POST["bookings"])) {
        $user_id = $_SESSION["user"];
        $course_id = $_GET["id"];
        $booking_date = date("Y-m-d");
        $bookingSql = "INSERT INTO `bookings`(`fk_user_id`, `fk_course_id`) VALUES ('{$user_id}','{$course_id}')";
        if (mysqli_query($connection, $bookingSql)) {
            echo "Course has been booked. Gratulation!";
        } else {
            echo "Something went wrong.Please try again!";
        }
    }
}

foreach ($rows as $row) {

    $layout = '<div class="detailContainer">
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
            <a href="courses.php">Go Back</a>
        </div>
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
    <title>Course Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/details.css">


    <style>
        .detailsProp {
            justify-content: center;
            align-items: center;
            text-align: center;
            border: black solid 2px;
        }

        .textRow {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .card-text,
        .card-title {
            text-align: center;
        }

        .btnAlign {
            display: flex;
            justify-content: space-around;
        }
    </style>


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