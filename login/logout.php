<?php
session_start();

unset($_SESSION["admin"]);
unset($_SESSION["user"]);
unset($_SESSION["trainer"]);

session_destroy();

header("Location: ../index.php");
