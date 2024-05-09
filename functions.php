<?php

function cleanInput($var){
    $name = trim($var);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    return $name;
}
