<?php

include_once("classes/Dbconfig.php");

$connectMysql = new Dbconfig();

$mysqli = new mysqli($connectMysql->servername, $connectMysql->username, $connectMysql->password,
    $connectMysql->dbname);
if ($mysqli->connect_errno) {
    echo "Не вдалось підключитись до MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}