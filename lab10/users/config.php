<?php

session_start();
$conn = mysqli_connect("localhost", "root", "111", "hrushevskuy");

if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}
