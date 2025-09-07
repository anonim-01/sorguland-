<?php

error_reporting(0);

session_start();

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "agahyoutube";

try {
	$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $ex) {
	exit('Error: database connection failed');
	die();
}

$UserAgent = $_SERVER['HTTP_USER_AGENT'];

if ($UserAgent == "" || $UserAgent == '' || empty($UserAgent) || $UserAgent == null) {
	exit('Error: no user agent');
	die();
}
