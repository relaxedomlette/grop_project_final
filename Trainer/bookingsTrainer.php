<?php

session_start();

// Validation start:

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/dashboardUser.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: ../Admin/dashboardAdmin.php");
}

// Validation end

// Connection start:

require_once "../db_connection.php";
require_once "../functions.php";

// Connection end

$userId = $_SESSION['user_id'];


// $courses_query = "SELECT * FROM courses WHERE  ";
// $courses_result = mysqli_query($connection, $courses_query);

$layout = "";

// if (mysqli_num_rows($courses_result) == 0) {
//     $layout = "There are no courses at the moment!";
// } else {
//     $rows = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);
//     foreach ($rows as $index => $course_row) {
//         $layout .= "
//       <div class='course'>
//           <div class='course-left'>
//               <div class='card-holder'>
//                   <img class='card-img' src='/Images/{$course_row["picture"]}' alt='Image description' />
//                   <h4 class='card-title'>Details</h4>
//                   <a href='detailsCourses.php?id={$course_row["id"]}' class='card-btn'>Details</a>
//               </div>
//           </div>
//           <div class='info'>
//               <h4 class='course-title'>{$course_row["subject"]}(m/w/d)</h4>
//               <p class='course-date'>Duration: {$course_row["duration"]}mins.</p>
//               <p class='course description'>
//                   The media group around the oe24 network is one of the young and
//                   dynamic players on the domestic market. With a newly established
//                   internal structure, flat hierarchies and a young management team.
//               </p>
//           </div>

//       </div>";
//         if ($index < count($rows) - 1) {
//             $layout .= "<div class='splitter'></div>";
//         }
//     }
// }




$sqlTrainerDetails = "SELECT * FROM users WHERE id = {$userId}";
$result = mysqli_query($connection, $sqlTrainerDetails);
$row = mysqli_fetch_assoc($result);
$TrainerEmail = $row['email'];

// var_dump($userId);
// var_dump($TrainerEmail);

// var_dump($TrainerEmail);
// $sqlGetUsers = "SELECT * FROM `users`
//                  WHERE `id` in (SELECT fk_user_id from bookings where fk_course_id = $id)";
// $sqlGetUsers = "SELECT users.firstName, users.secondName, users.email, bookings.id
//                     FROM `users`
//                     JOIN `bookings` ON users.id = bookings.fk_user_id 
//                     WHERE bookings.fk_course_id = $id";
$courses = "";
$sqlGetCourses = "SELECT u.id,u.picture, u.firstName, u.secondName, u.email, c.subject, c.name, c.capacity, c.date
FROM users u
JOIN bookings b ON b.fk_user_id = u.id
JOIN courses c ON b.fk_course_id = c.id
WHERE c.email = '$TrainerEmail' 
";

// "SELECT users.id
//                 FROM users
//                 JOIN bookings ON users.id = bookings.fk_user_id
//                 JOIN courses ON bookings.fk_course_id = courses.id
//                 WHERE courses.id = $course_id";


// var_dump($sqlGetCourses);

$courses_result = mysqli_query($connection, $sqlGetCourses);
// var_dump($courses_result);
if (mysqli_num_rows($courses_result) > 0) {
    $rows = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);
    foreach ($rows as  $value) {
        $courses .= "<div class='col'>
        <div class='card h-100'>
            <a href='detailsUsers.php?id={$value["id"]}'>
                <img src='../Images/{$value["picture"]}' class='card-img-top rounded-circle img' alt='{$value["firstName"]}'>
            </a>
            <div class='card-body text-center'>
                <h5 class='card-title'>{$value["firstName"]} {$value["secondName"]}</h5>
                <h5 class='card-title'>{$value["name"]}</h5>
                <h5 class='card-title'>{$value["date"]}</h5>
            </div>
        </div>
    </div>";
    }
} else {
    $courses = "no courses found";
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booked Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/admin-users.css">
</head>

<body>
    <div class="container">
        <div class="courses">
            <h2 class="">All Bookings</h2>
            <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-30">
                <?= $courses ?>
            </div>
        </div>
    </div>
    <br><br><br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>