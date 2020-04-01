<?php

$servername = "localhost";
$username = "root";
$password = "111";
$dbname = "monitors";

$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_errno) {
    echo "Не вдалось підключитись до MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}