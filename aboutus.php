<?php
session_start();
require_once "db_connection.php";
require_once "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/aboutus.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <div class="background">
        <img class="bkgr" src="/Images/backgr.jpg" alt="">
        <div class="hero">
            <div class="left">
                <h1 class="title">Our Story</h1>
            </div>
            <div class="card-container">
                <div class="card">
                    <img class="img-content" src="images/team.jpg" alt="">
                    <div class="content">
                        <p class="heading">Tutor Master</p>
                        <p style="font-weight: 600;">
                            Welcome to Tutor Masters, where academic excellence meets personalized guidance. We specialize in providing top-tier tutoring services designed to empower students on their journey to educational success. With a dedicated team of experienced tutors and a commitment to individualized learning, we strive to unlock the full potential of every student, ensuring a brighter future ahead.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section1">
        <section class="company-info">
            <h2>About Tutor Masters</h2>
            <p> In the heart of a bustling city, Tutor Masters emerged from a simple idea shared among friends at a local coffee shop. Determined to make a difference, CEO Anna and her team of educators poured their passion into building a platform that would redefine tutoring. With personalized learning at its core, Tutor Masters quickly gained traction, attracting students from all walks of life. Through innovative teaching methods and a commitment to excellence, Tutor Masters became a beacon of hope for those striving to achieve academic success. Today, their story continues to inspire, proving that with dedication and vision, anything is possible.</p>
            <p>Tutor Masters goes beyond traditional tutoring services by offering a holistic approach to education. We understand that academic success is not just about mastering subjects but also about developing critical thinking skills, fostering creativity, and nurturing a love for learning. That's why our tutors are not only experts in their respective fields but also passionate educators who inspire and motivate students to reach their full potential.</p>
            <p>Our tutoring sessions are not limited to traditional classroom settings. We embrace innovative teaching methods and utilize technology to create engaging and interactive learning experiences. From virtual classrooms to interactive online resources, we provide students with the tools they need to excel in today's digital age.</p>
        </section>
    </div>
    <div class="container5">
        <div class="heading-container">
            <h5>Meet our exceptional team dedicated to guiding future scholars, ensuring success, and unlocking potential in every student's academic journey. Our tutors are not just educators; they are mentors, motivators, and champions of learning. With years of experience and a passion for teaching, they provide personalized support tailored to each student's unique needs, empowering them to excel in their studies and beyond.
                <br>
                In addition to our dedicated team of tutors, we are proud to introduce our talented group of trainers. These professionals bring a wealth of knowledge and expertise to Tutor Masters, enriching our educational programs with innovative teaching methods and real-world experience. Whether it's through interactive workshops, hands-on exercises, or insightful lectures, our trainers inspire students to think critically, solve problems creatively, and embrace lifelong learning. Together, our team of tutors and trainers is committed to nurturing the next generation of scholars and shaping a brighter future for all. We believe in fostering a collaborative and supportive learning environment where every student can thrive and reach their full potential.
                <h5>
        </div>
        <div class="card-carousel">
            <div class="card" id="1">
                <div class="image-container"></div>
                <h2 class="name">Marianne Van Zeller</h2>
                <p>Expert tutor guiding students towards university success.</p>
            </div>
            <div class="card" id="2">
                <div class="image-container"></div>
                <h2 class="name">Ai WeiWei</h2>
                <p>Experienced educator mentoring students for university admissions.</p>
            </div>
            <div class="card" id="3">
                <div class="image-container"></div>
                <h2 class="name">Alicia Keys</h2>
                <p>Seasoned instructor helping students excel in university entrance.</p>
            </div>
            <div class="card" id="4">
                <div class="image-container"></div>
                <h2 class="name">Ulrich Løvenskjold</h2>
                <p>Accomplished mentor guiding students into university pathways.</p>
            </div>
            <div class="card" id="5">
                <div class="image-container"></div>
                <h2 class="name">Jessie Combs</h2>
                <p>Proven tutor facilitating students' journey to university acceptance.</p>
            </div>
        </div>
        <a href="#" class="visuallyhidden card-controller">Carousel controller</a>
    </div>

    <div id="Carousel-slider">
        <section>
            <div class="Carousel-slider">
                <!-- Background Images div -->
                <div class="slider-item superHero1" data-href="#"></div>
                <div class="slider-item superHero2" data-href="#"></div>
                <div class="slider-item superHero3" data-href="#"></div>
                <div class="slider-item superHero4" data-href="#"></div>
                <div class="slider-item superHero5" data-href="#"></div>
                <div class="slider-item superHero6" data-href="#"></div>
                <div class="slider-item superHero7" data-href="#"></div>
                <!-- Background Images div End -->
            </div>
        </section>
    </div>

    <div class="faq">
        <div class="container2">
            <div class="titleh2">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Why should I consider university tutoring?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>University tutoring can significantly improve your chances of getting accepted into your desired universities. Our tutors provide personalized guidance, help you prepare for entrance exams, and assist with application essays, increasing your overall competitiveness.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">How do university tutors help students?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>University tutors offer tailored support to students by identifying their strengths and weaknesses, creating customized study plans, providing resources and practice materials, offering feedback on academic performance, and guiding them through the university application process.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">What qualifications do your tutors have?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Our tutors are highly qualified professionals with extensive experience in university admissions and tutoring. They possess advanced degrees from prestigious universities, undergo rigorous training, and stay updated on the latest educational trends and techniques.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">How can I get started with university tutoring?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Getting started with university tutoring is easy. Simply contact us to schedule a consultation with one of our tutors. During the consultation, we'll assess your academic goals, discuss your tutoring needs, and create a personalized plan to help you succeed.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">What sets your university tutoring apart?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Our university tutoring stands out due to our personalized approach, experienced tutors, comprehensive resources, and track record of success. We prioritize the individual needs of each student, ensuring they receive the support and guidance necessary to excel academically and gain admission to top universities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/micro-slider@1.0.9/dist/micro-slider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <?php include "footer.php" ?>
</body>

</html>