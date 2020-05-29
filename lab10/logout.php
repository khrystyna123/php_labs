<?php

session_start();
session_unset($_SESSION['user']);
session_destroy();
header('location: pages/home.php');
