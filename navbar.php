<link rel="stylesheet" href="style/navbar.css">

<?php

$nav = '';

if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    $nav = "
        <link rel='stylesheet' href='../style/navbar.css'>
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='container'>
                <a class='navbar-brand' href='index.php'>
                    <img class='nav-icon' src='../Images/logo.png' alt=''>
                </a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav flex-grow-1'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'>Home</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='courses.php'>Courses</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='aboutus.php'>About Us</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='contactus.php'>Contact Us</a>
                        </li>
                    </ul>
                    <ul class='navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='login/login.php'>Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    ";
}

if (isset($_SESSION["user"])) {
    $nav = "
        <link rel='stylesheet' href='../style/navbar.css'>
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='container'>
                <a class='navbar-brand' href='index.php'>
                    <img class='nav-icon' src='../Images/logo.png' alt=''>
                </a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav flex-grow-1'>
                    <li class='nav-item'>
                            <a class='nav-link' href='../index.php'>Home</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='User/coursesUser.php'>Courses</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='aboutus.php'>About Us</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='contactus.php'>Contact Us</a>
                        </li>
                    </ul>
                    <ul class='navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='User/dashboardUser.php'>Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    ";
}

if (isset($_SESSION["trainer"])) {
    $nav = "
        <link rel='stylesheet' href='../style/navbar.css'>
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='container'>
                <a class='navbar-brand' href='index.php'>
                    <img class='nav-icon' src='../Images/logo.png' alt=''>
                </a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav flex-grow-1'>
                    <li class='nav-item'>
                            <a class='nav-link' href='../index.php'>Home</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='courses.php'>Courses</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='aboutus.php'>About Us</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='contactus.php'>Contact Us</a>
                        </li>
                    </ul>
                    <ul class='navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='Trainer/dashboardTrainer.php'>Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    ";
}

if (isset($_SESSION["admin"])) {
    $nav = "
        <link rel='stylesheet' href='../style/navbar.css'>
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='container'>
                <a class='navbar-brand' href='index.php'>
                    <img class='nav-icon' src='../Images/logo.png' alt=''>
                </a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav flex-grow-1'>
                    <li class='nav-item'>
                            <a class='nav-link' href='../index.php'>Home</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='courses.php'>Courses</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='aboutus.php'>About Us</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='contactus.php'>Contact Us</a>
                        </li>
                    </ul>
                    <ul class='navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='Admin/dashboardAdmin.php'>Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    ";
}
?>

<?= $nav ?>