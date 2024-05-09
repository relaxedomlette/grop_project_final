<?php



session_start();

include_once '../db_connection.php';


if (!isset($_SESSION['admin']) && !isset($_SESSION['trainer']) && !isset($_SESSION['user'])) {
    header('Location: ../login/login.php');
}



$user_id = $_SESSION['user'];


$review_query = "SELECT * FROM review WHERE fk_user_id = $user_id";
$review_result = mysqli_query($connection, $review_query);

$layout = '';

if (mysqli_num_rows($review_result) == 0) {
    $layout = 'No reviews!';
} else {
    while ($review_row = mysqli_fetch_assoc($review_result)) {
        $course_id = $review_row['fk_course_id'];
        // Abfrage, um die Details des Kurses abzurufen
        $course_query = "SELECT * FROM courses WHERE id = $course_id"; // Fixing the query
        $course_result = mysqli_query($connection, $course_query); // Executing the query
        if ($course_result && mysqli_num_rows($course_result) == 1) {
            $course_row = mysqli_fetch_assoc($course_result); // Fetching course details
            // Kursdetails anzeigen
            $layout .= "
            <div class='plan'>
            <div class='inner'>
                <span class='pricing'>
                    <span>
                    {$review_row['rating']}/5
                    </span>
                </span>
                <p class='title'><strong>Subject:</strong><br> {$course_row['subject']}</p>
                <p class='info'><strong>Comment:</strong> {$review_row['comment']}</p>
                <ul class='features'>
                    <li>
                        <span class='icon'>
                            <svg height='24' width='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M0 0h24v24H0z' fill='none'></path>
                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'></path>
                            </svg>
                        </span>
                        <span><strong>Teacher:</strong> {$course_row['teacher']}</span>
                    </li>
                    <li>
                        <span class='icon'>
                            <svg height='24' width='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M0 0h24v24H0z' fill='none'></path>
                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'></path>
                            </svg>
                        </span>
                        <span><strong>Date:</strong> {$course_row['date']}</span>
                    </li>
                </ul>
                <div class='action'>
                <a class='button' href='updatereview.php?id={$review_row['id']}'>Update</a>
                <a href='deletereview.php?id={$review_row['id']}' class='button bg-danger'>Delete</a>
                </div>
            </div>
        </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>My Booked Courses</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel='stylesheet' href='../style/CRUD.css'>
    <link rel='stylesheet' href='../style/CRUD-responsive.css'>
</head>

<body>
    <div class='container'>
        <div class='courses'>
            <h2 class=''>My Reviews</h2>
            <div class='list3'>
                <?= $layout ?>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz' crossorigin='anonymous'></script>
</body>

</html>