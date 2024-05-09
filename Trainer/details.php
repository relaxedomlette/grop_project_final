<?php
session_start();
if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"])) {
    header("Location: ../login/login.php");
}
if (isset($_SESSION["user"])) {
    header("Location: ../User/indexUser.php");
}

require_once "../db_connection.php";



$userId = $_SESSION['user_id'];



$id = $_GET['id'];

$sqlTrainerDetails = "SELECT * FROM users WHERE id = {$userId}";
$result = mysqli_query($connection, $sqlTrainerDetails);
$row = mysqli_fetch_assoc($result);
$TrainerEmail = $row['email'];

// Kurse abrufen, die dem Trainer zugeordnet sind
$courses = "";
$sqlGetCourses = "SELECT * FROM `courses` WHERE email = '{$TrainerEmail}' and id = '{$id}'";
$courses_result = mysqli_query($connection, $sqlGetCourses);
if (mysqli_num_rows($courses_result) > 0) {
    $rows = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);
    foreach ($rows as $row) {
        $course_id = $row['id'];
        // var_dump($course_id);
        $courses .= '
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
                <div class="btnDetails" style="background-color: red; color: #fff;">
                    <a href="deleteCourses.php?id=' . $course_id . '">Delete Course</a>
                </div>
                <div class="btnDetails" style="background-color: orange; color: #fff;">
                    <a href="updateCourses.php?id=' . $course_id . '">Update Course</a>
                </div>
                <div class="btnDetails" style="background-color: #38D9A9; color: #fff;">
                    <a href="dashboardTrainer.php">Go Back</a>
                </div>
            </div>
        </div>
    </div>';
    }
} else {
    $courses = "No courses found";
}
$userId = $_SESSION['user_id'];

$sqlUser = "SELECT * FROM `courses` WHERE `id` = $userId";


$runSqlUser = mysqli_query($connection, $sqlUser);



// Annahme: $course_id ist die ID des Kurses, die aus der URL oder anderweitig erhalten wurde
$course_id = $_GET['id'];

$sqlGetBookingId = "SELECT bookings.id FROM bookings";
$result1 = mysqli_query($connection, $sqlGetBookingId);
$booking_id = $row['id'];


$sqlGetUser = "SELECT users.id
                FROM users
                JOIN bookings ON users.id = bookings.fk_user_id
                JOIN courses ON bookings.fk_course_id = courses.id
                WHERE courses.id = $course_id";

// Führen Sie die Abfrage aus und holen Sie die Ergebnisse ab
$result2 = mysqli_query($connection, $sqlGetUser);


// Führen Sie die SQL-Abfrage aus
$sqlGetUsers = "SELECT users.firstName, users.secondName, users.email, users.id
                FROM users
                JOIN bookings ON users.id = bookings.fk_user_id
                JOIN courses ON bookings.fk_course_id = courses.id
                WHERE courses.id = $course_id";

// Führen Sie die Abfrage aus und holen Sie die Ergebnisse ab
$result = mysqli_query($connection, $sqlGetUsers);



// if (($result) == 0) {


// } else {$row1 = mysqli_fetch_assoc($result);
// $user_id = $row1['id'];}

// var_dump($row1);
// var_dump($result);

$layout1 = "";

if (mysqli_num_rows($result2) == 0) {
    $layout1 = "There are no students enrolled yet!";
} else {
    $layout1 = "
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>";

    while ($value = mysqli_fetch_assoc($result)) {
        $layout1 .= "
            <tr>
                <td>{$value["firstName"]}</td>
                <td>{$value["secondName"]}</td>
                <td>{$value["email"]}</td>
                <td><a class='action' href='removeStudent.php?courseId={$booking_id}&userid={$value["id"]}'>Remove student</a></td>
            </tr>
        ";
    }
}
// <tr>
// <td>{$valu["firstName"]}</td>
// <td>{$valu["secondName"]}</td>
// <td>{$valu["email"]}</td>
// <td><a href='removeStudent.php?courseId={$booking_id}&userid={$user_id}'>Remove student</a>
// </tr>
// </table>



//                     ";


//     }};





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Details</title>
    <link rel="stylesheet" href="../style/details.css">
</head>

<body>
    <div>
        <img class="bkgr" src="../Images/courses-banner.jpg" alt="">
        <div class="detail">
            <div>
                <?= $courses ?>
            </div>
        </div>
        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br><br>
        <div class="tableContainer">
            <h1 class="title">All the students enrolled in this course</h1>
            <div class="table">
                <table class='student-table'>
                    <?= $layout1 ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>