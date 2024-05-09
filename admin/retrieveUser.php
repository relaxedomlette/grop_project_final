<?php
session_start();

// Validation start:
if (!isset($_SESSION["admin"]) && !isset($_SESSION["trainer"]) && !isset($_SESSION["user"])) {
    header("Location: ../login/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../User/indexUser.php");
}

if (isset($_SESSION["trainer"])) {
    header("Location: ../Trainer/indexTrainer.php");
}
// Validation end

// Connection start:
require_once "../db_connection.php";
require_once "../functions.php";
// Connection end

$layout = "";

$sql = "SELECT * FROM `users`";
$runSql = mysqli_query($connection, $sql);

if (mysqli_num_rows($runSql) == 0) {
    $layout = "No results";
} else {
    $rows = mysqli_fetch_all($runSql, MYSQLI_ASSOC);
    foreach ($rows as $val) {
        $layout .=
            "<div class='col'>
                <div class='card h-100'>
                    <a href='detailsUsers.php?id={$val["id"]}'>
                        <img src='../Images/{$val["picture"]}' class='card-img-top rounded-circle img' alt='{$val["firstName"]}'>
                    </a>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>{$val["firstName"]} {$val["secondName"]}</h5>
                    </div>
                </div>
            </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/admin-users.css">
</head>

<body>
    <div class="container" id="centerSection">
        <div class="top">
            <h1>Users</h1>
            <a class="createInput" id="createUserBtn" href="createUser.php">
                <input class="create" type="submit" name="create" value="Create User">
            </a>
        </div>

        <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-30">
            <?= $layout ?>
        </div>
    </div>
</body>

</html>