<?php

session_start();

$user = $_SESSION["user"];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header("Location: https://survival-mo.de/");
	exit();
}

$country = $_POST["country"];
$timezone = $_POST["timezone"];
$fav_level = $_POST["fav_level"];
$fav_pers = $_POST["fav_pers"];
$discord = $_POST["discord"];
$website = $_POST["website"];

$user_data = json_decode(file_get_contents("../.users_data/users/$user"));
$user_data->country = $country;
$user_data->timezone = $timezone;
$user_data->fav_level = $fav_level;
$user_data->fav_pers = $fav_pers;
$user_data->discord = $discord;
if(trim($website))
{
	if(filter_var(trim($website), FILTER_VALIDATE_URL))
	{
		$user_data->website = $website;
	}
	else {
		header("Location: https://survival-mo.de/profile_editor?e=1");
		exit();
	}
} else {
	$user_data->website = $website;
}
$user_data_json = json_encode($user_data);

$user_file = fopen("../.users_data/users/$user", 'w');
fwrite($user_file, $user_data_json);
fclose($user_file);

header("Location: https://survival-mo.de/profile_editor/");

?>
