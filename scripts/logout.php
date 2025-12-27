<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header("Location: https://survival-mo.de/");
	exit();
}

if (session_status() !== PHP_SESSION_NONE) {
    session_destroy();
}

header("Location: https://survival-mo.de");

?>