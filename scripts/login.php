<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header("Location: https://survival-mo.de/");
	exit();
}

$nickname = $_POST["nickname"];
$password = $_POST["password"];

if (!trim($nickname) || !trim($password)) {
	header("Location: https://survival-mo.de/?e=1");
	exit();
}

if (!file_exists("../.users_data/users/$nickname")) {
	header("Location: https://survival-mo.de/?e=2");
	exit();
}

$user_file = file_get_contents("../.users_data/users/$nickname");
$password_hashed = json_decode($user_file)->password;
if (!password_verify($password, $password_hashed)) {
	header("Location: https://survival-mo.de/?e=3");
	exit();
}

$_SESSION["user"] = $nickname;

header("Location: https://survival-mo.de");

?>