<?php
session_start();

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

require "../db_connection.php";

$path = '';
if ($_GET["id"]) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM courses WHERE id = {$id}";
    $result = mysqli_query($connection, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
    }

//     } else {
//         // header("location: error.php");
//     }
//     // mysqli_close($connection);
// } else {
//     // header("location: error.php");
// }
$path = $_GET['path'];
}

if (isset($_POST["bookings"])) {
    $user_id = $_SESSION["user"];
    $course_id = $_GET["id"];
    // var_dump($course_id);

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
            // echo "Course has been booked. Gratulation!";
            header("Location: details.php?id= {$course_id}&path=dashboardUser.php");
        } else {
            echo "Something went wrong. Please try again!";
        }
    }
    header("refresh");
}


$user_id = $_SESSION["user"];
$course_id = $_GET["id"];
// var_dump($user_id);
// var_dump($course_id);

$bookedSql = "SELECT * FROM bookings WHERE fk_user_id = $user_id AND fk_course_id = $course_id 
";
$checkBookings = mysqli_query($connection, $bookedSql);

// var_dump($bookedSql);

// var_dump($checkBookings);
$layout = '';
if (mysqli_num_rows($checkBookings) > 0) {


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
        <div class="btnDetails" style="background-color: red; color: #fff;">
        <a href="deletecourses.php?course_id=' . $row["id"] . '&user_id=' . $user_id . '&path='.$path.'">Remove Course</a>
    
    </div>
            <div class="btnDetails" style="background-color: #F99646; color: #fff;">
                <a href="review.php?course_id=' . $row["id"] . '&user_id=' . $user_id . '">rate this course</a>
            </div>
            <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
                <a href=' . $path . '>back to home</a></div>
            </div>
        </div>
    </div>';
    }
} else {

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
            <div class="d-flex justify-content-between infoBox">
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
                <form method="post" style="margin: 0;">
                    <input class="btnDetails bg-success" type="submit" name="bookings" value="book course">
                </form>
                
                <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
                    <a href=' . $path . '>back to home</a></div>
                </div>
            </div>
        </div>';
    }
    // header("Refresh");
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