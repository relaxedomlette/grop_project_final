<?php

session_start();

include_once '../db_connection.php';


if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
  header("Location: ../login/login.php");
}

if (isset($_SESSION["admin"])) {
  header("Location: ../Admin/dashboardAdmin.php");
}

if (isset($_SESSION["trainer"])) {
  header("Location: ../Trainer/dashboardTrainer.php");
}



$user_id = $_SESSION['user'];
$path = '';

$booking_query = "SELECT * FROM bookings WHERE fk_user_id = $user_id";
$booking_result = mysqli_query($connection, $booking_query);

$layout = "";

if (mysqli_num_rows($booking_result) == 0) {
  $layout = "You haven't booked any courses yet!";
} else {
  $index = 0;
  while ($booking_row = mysqli_fetch_assoc($booking_result)) {
    $course_id = $booking_row['fk_course_id'];
    // Abfrage, um die Details des Kurses abzurufen
    $course_query = "SELECT * FROM courses WHERE id = $course_id";
    $course_result = mysqli_query($connection, $course_query);
    if ($course_result && mysqli_num_rows($course_result) == 1) {
      $course_row = mysqli_fetch_assoc($course_result);

      // Kursdetails anzeigen
      $layout .= "
      <div class='course'>
          <div class='course-left'>
              <div class='card-holder'>
                  <img class='card-img' src='/Images/{$course_row["picture"]}' alt='Image description' />
                  <h4 class='card-title'>Details</h4>
                  <a href='details.php?id={$course_row["id"]}&path=dashboardUser.php' class='card-btn'>Details</a>
              </div>
          </div>
          <div class='info'>
              <h4 class='course-title'>{$course_row["subject"]}(m/w/d)</h4>
              <p class='course-date'>Duration: {$course_row["duration"]}mins.</p>
              <p class='course description'>
              Delve into an extensive range of topics with engaging content, meticulously crafted to enrich your skills and knowledge. Experience dynamic learning, igniting growth and development.
              </p>
          </div>
      </div>";
      $index++;

      // Check if this is not the last row, then add the separator
      if ($index < mysqli_num_rows($booking_result)) {
        $layout .= "<div class='splitter'></div>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Booked Courses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/CRUD.css">
  <link rel="stylesheet" href="../style/CRUD-responsive.css">
</head>

<body>
  <div class="container">
    <div class="courses">
      <h2 class="">My Booked Courses</h2>
      <div class="list">
        <?= $layout ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>