<?php
session_start();
require_once "db_connection.php";
require_once "navbar.php";

$readQuery = "SELECT courses.subject , users.firstName, users.secondName, users.picture, review.* FROM courses JOIN review ON courses.id = review.fk_course_id JOIN users ON users.id = review.fk_user_id";
$reviewsResult = mysqli_query($connection, $readQuery);

$readQuery = "SELECT * FROM courses
ORDER BY `date` ASC LIMIT 4";
$readResult = mysqli_query($connection, $readQuery);

$layout = "";
$review = "";

if (mysqli_num_rows($readResult) == 0) {
    $layout = "No courses found!";
} else {
    $rows = mysqli_fetch_all($readResult, MYSQLI_ASSOC);
    foreach ($rows as $value) {
        $date =  strtotime($value["date"]);
        $date = date("j F Y", $date);


        $layout .= "
        <div class='card-holder'>
            <img class='card-img' src='/Images/{$value["picture"]}' alt='Image description' />
            <h4 class='card-title'>{$value["subject"]}</h4>
            <div class='card-info'>
            <p class='card-date'>{$date}</p>
            <p class='card-duration'>{$value["duration"]}mins.</p>
            </div>
            <a href='details4all.php?id={$value["id"]}' class='card-btn'>Details</a>
        </div>";
    }
}

$reviewsRows = mysqli_fetch_all($reviewsResult, MYSQLI_ASSOC);

foreach ($reviewsRows as $value) {
    $review .= "
    <div class='carousel-item' id='item'>
        <div class='all'>
            <div class='testimonials-left'>
                <img class='testimonials-pic' src='/Images/{$value["picture"]}' alt=''>
            </div>
            <div class='testimonials-right'>
                <h4 class='testimonials-name'>{$value["firstName"]} {$value["secondName"]}</h4>
                <p class='testimonials-subject'>{$value["subject"]}</p>
                <div class='rating-outer'>
                    <div style='width: calc(20% * {$value["rating"]});' class='rating-inner'></div>
                    <img class='rating' src='/Images/rating.png' alt='' title='{$value["rating"]}'>
                </div>
                <p class='testimonials-comment'>''{$value["comment"]}''</p>
            </div>
        </div>
    </div>";
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/index.css">
</head>

<body>
    <div class="background">
        <img class="bkgr" src="/Images/backgr.jpg" alt="">
        <div class="hero">
            <div class="left">
                <h1 class="title">Unlock your potential<br> with the best<br> university tutors.</h1>
                <a class="submitInput" href="courses.php">
                    <input class="submitBtn" type="submit" name="submit" value="Get Started">
                </a>
            </div>
            <div class="right">
                <img class="banner" src="images/banner.png" alt="">
            </div>
        </div>
    </div>
    <div class="info">
        <div class="grid-info">
            <div class="grid-items">
                <img class="icon" src="/Images/star.png" alt="">
                <h6>Expert teaching staff comprised of leading educators in various fields.</h6>
            </div>
            <div class="grid-items">
                <img class="icon" src="/Images/person.png" alt="">
                <h6>Personalized mentorship tailored to individual learning styles and needs.</h6>
            </div>
            <div class="grid-items">
                <img class="icon" src="/Images/book.png" alt="">
                <h6>Comprehensive study materials and resources to aid in exam preparation.</h6>
            </div>
            <div class="grid-items">
                <img class="icon" src="/Images/seo.png" alt="">
                <h6>Proven strategies and techniques for optimizing academic performance.</h6>
            </div>
            <div class="grid-items">
                <img class="icon" src="/Images/calendar.png" alt="">
                <h6>Flexible scheduling options to accommodate busy student lifestyles.</h6>
            </div>
            <div class="grid-items">
                <img class="icon" src="/Images/flag.png" alt="">
                <h6>Continuous support and guidance throughout the university admission process.</h6>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="courses">
            <h3 class="upcoming">Upcoming Courses</h3>
            <div class="row row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2">
                <?= $layout ?>
            </div>
            <a class="submitInput" href="courses.php">
                <input class="courses-btn" type="submit" name="submit" value="All Courses">
            </a>
        </div>
    </div>
    <div class="testimonials">
        <div id="testimonials" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active" id="item">
                    <div class="all">
                        <div class='testimonials-left'>
                            <img class='testimonials-pic' src='/Images/defaultPic.jpg' alt=''>
                        </div>
                        <div class='testimonials-right'>
                            <h4 class='testimonials-name'>Jordan Patel</h4>
                            <p class='testimonials-subject'>History</p>
                            <div class="rating-outer">
                                <div style="width: 90%;" class='rating-inner'></div>
                                <img class='rating' src='/Images/rating.png' alt='' title="4.5/5">
                            </div>
                            <p class='testimonials-comment'>''The support system provided by the tutors was excellent! They were always available to answer my questions and address concerns. Their guidance was invaluable in navigating the university application process, making me feel more confident and prepared.''</p>
                        </div>
                    </div>
                </div>
                <?= $review ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonials" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonials" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container container-mission">
        <div class="mission">
            <div class="mission-text">
                <h1>Our Mission</h1>
                <img class="mission-img-mobile" src="https://www.schooliseasy.com/wp-content/uploads/Picture1.png" alt="">
                <h5>
                    Our aim to empower students on their journey towards academic success and university admission. We are committed to providing personalized, high-quality tutoring services that cater to each student's unique learning needs. Through our expert guidance, comprehensive study materials, and continuous support, we strive to instill confidence, inspire excellence, and help students achieve their educational goals. We believe in fostering a positive and enriching learning environment where every student can thrive and reach their full potential.
                </h5>
            </div>
            <img class="mission-img" src="https://www.schooliseasy.com/wp-content/uploads/Picture1.png" alt="">
        </div>
    </div>
    <div class="awards">
        <div class="awards-inner">
            <img src="/Images/2017.png" alt="">
            <img src="/Images/2021.png" alt="">
            <img src="/Images/2022.png" alt="">
        </div>
    </div>

    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>