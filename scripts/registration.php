<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header("Location: https://survival-mo.de/");
	exit();
}

$nickname = $_POST["nickname"];
$password = $_POST["password"];
$password_confirm = $_POST["password_confirm"];
$country = $_POST["country"];
$timezone = $_POST["timezone"];

if(!trim($nickname) or !trim($password) or !trim($password_confirm)) {
	header("Location: https://survival-mo.de/registration?e=1");
	exit();
}

if(strlen($nickname) > 16){
	header("Location: https://survival-mo.de/registration?e=2");
	exit();
}

if($password != $password_confirm) {
	header("Location: https://survival-mo.de/registration?e=3");
	exit();
}

if(file_exists("../.users_data/users/$nickname")){
	header("Location: https://survival-mo.de/registration?e=4");
	exit();
}

if(str_contains($nickname, '/') or str_contains($password, '/')){
	header("Location: https://survival-mo.de/registration?e=5");
	exit();
}

$user_ip = $_SERVER['REMOTE_ADDR'];
	
$used_ips = file_get_contents("../.users_data/used_ips");
if(str_contains($used_ips, $user_ip)){
	header("Location: https://survival-mo.de/registration?e=6");
	exit();
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$used_ips_file = fopen("../.users_data/used_ips", 'a');
fwrite($used_ips_file, $user_ip . "\n");
fclose($used_ips_file);

$user_data = new stdClass();
$user_data->password = $password_hash;
$user_data->country = $country;
$user_data->timezone = $timezone;
$user_data->reg_time = time();
$user_data->ip = $user_ip;
$user_data->bio = "";
$user_data->fav_pers = "";
$user_data->fav_level = "";
$user_data->discord = "";
$user_data->website = "";

$user_data_json = json_encode($user_data);

$user_file = fopen("../.users_data/users/$nickname", 'w');
fwrite($user_file, $user_data_json);
fclose($user_file);

$_SESSION["user"] = $nickname;

header("Location: https://survival-mo.de");

?>