<?php

require_once "db_connection.php";

if (isset($_GET['type']) && isset($_GET['id'])) {

    $filterType = $_GET['type'];
    $filterId = $_GET['id'];
    $filterQuery = "SELECT * FROM courses WHERE $filterType = '$filterId'";
    $filterResult = mysqli_query($connection, $filterQuery);

    $filteredCoursesHTML = "";

    if (mysqli_num_rows($filterResult) > 0) {
        $filteredCourses = mysqli_fetch_all($filterResult, MYSQLI_ASSOC);

        foreach ($filteredCourses as $index => $course) {
            $date = strtotime($course["date"]);
            $date = date("j F Y", $date);

            $filteredCoursesHTML .= "
            <div class='course'>
                <div class='course-left'>
                    <div class='card-holder'>
                        <img class='card-img' src='/Images/{$course["picture"]}' alt='Image description' />
                        <h4 class='card-title'>Details</h4>
                        <a href='details4all.php?id={$course["id"]}' class='card-btn'>Details</a>
                    </div>
                </div>
                <div class='info'>
                    <h4 class='course-title'>{$course["subject"]}(m/w/d)</h4>
                    <p class='course-date'>{$date} Duration: {$course["duration"]}mins.</p>
                    <p class='course description'>
                        The media group around the oe24 network is one of the young and
                        dynamic players on the domestic market. With a newly established
                        internal structure, flat hierarchies and a young management team.
                    </p>
                </div>
            </div>";

            if ($index < count($filteredCourses) - 1) {
                $filteredCoursesHTML .= "<div class='splitter'></div>";
            }
        }
    } else {
        $filteredCoursesHTML = "No courses found!";
    }

    echo $filteredCoursesHTML;
} else {
    echo "Error: Filter type and ID are required.";
}
