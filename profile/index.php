<?php
	session_start();

	if(!isset($_GET["u"])){
		if(isset($_SESSION["user"])){
			$user = $_SESSION["user"];
		} else {
			header("Location: https://survival-mo.de");
			exit();
		}
	} else {
		$user = urldecode($_GET["u"]);
	}

	if(!file_exists("../.users_data/users/$user")){
		$user_found = false;
	}
	else {
		$user_found = true;
	}

	$user_file = json_decode(file_get_contents("../.users_data/users/$user"));

	$user_country = $user_file->country;
	$user_bio = $user_file->bio;
	$user_fav_pers = $user_file->fav_pers;
	$user_fav_level = $user_file->fav_level;
	$user_discord = $user_file->discord;
	$user_website = $user_file->website;

	$user_timezone = $user_file->timezone;
	if(trim($user_timezone)){
	$user_timezone = $user_timezone/2*60;
	$hours = floor($user_timezone / 60);
	$minutes = ($user_timezone % 60);
	$user_timezone_display = sprintf('%02d:%02d', $hours, $minutes);
	}
	
	$user_reg_time = $user_file->reg_time;
	if(isset($_SESSION["user"]) and trim(json_decode(file_get_contents('../.users_data/users/' . $_SESSION["user"]))->timezone)){
		$user_reg_time += json_decode(file_get_contents('../.users_data/users/' . $_SESSION["user"]))->timezone/2*60*60;
	}
	$user_reg_time_display = date("d.m.Y H:i:s", $user_reg_time);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require_once '../templates/head.php';  ?>
		<?php echo '<title>SURVIVAL MODE :: ' . $user . '\'s profile</title>'; ?>
	</head>
	<body>
		<?php require_once '../templates/sky.php';  ?>
		<div id="page">
			<?php require_once '../templates/header.php'; ?>
			<div id="content">
				<?php require_once '../templates/content_nav.php';  ?>
				<div id="content_main">
					<div class="text_section">
						<div class="text_section_caption">
							<?php if($user_found) {
								echo "<p>$user's profile</p>";
							} else {
								echo "<p>User not found</p>";
							} ?>
						</div>
						<div class="text_section_content">
							<?php if($user_found) { ?>
							<dl id="profile_dl">
								<?php if(trim($user_country)) { ?><dt>Country:</dt>
								<dd><?php echo htmlspecialchars($user_country, ENT_QUOTES); ?></dd><?php } ?>

								<?php if(trim($user_timezone)) { ?><dt>Timezone:</dt>
								<dd>UTC + <?php echo htmlspecialchars($user_timezone_display, ENT_QUOTES); ?></dd><?php } ?>

								<?php if(trim($user_bio)) { ?><dt>Bio:</dt>
								<dd><?php echo htmlspecialchars($user_bio, ENT_QUOTES); ?></dd><?php } ?>

								<?php if(trim($user_discord)) { ?><dt>Discord:</dt>
								<dd><?php echo htmlspecialchars($user_discord, ENT_QUOTES); ?></dd><?php } ?>

								<?php if(trim($user_website)) { ?><dt>Website:</dt>
								<dd><a href="<?php echo htmlspecialchars($user_website, ENT_QUOTES); ?>"><?php echo $user_website; ?></a></dd><?php } ?>

								<?php if(trim($user_fav_pers)) { ?><dt>Favorite Supercow Character:</dt>
								<dd><?php echo htmlspecialchars($user_fav_pers, ENT_QUOTES); ?></dd><?php } ?>

								<?php if(trim($user_fav_level)) { ?><dt>Favorite Supercow Level:</dt>
								<dd><?php echo htmlspecialchars($user_fav_level, ENT_QUOTES); ?></dd><?php } ?>

								<dt>Registration time:</dt>
								<dd><?php echo htmlspecialchars($user_reg_time_display, ENT_QUOTES); ?></dd>
							</dl>
							<?php } else { ?>
								<p>The user named <b><?php echo $user; ?></b> does not exist on the site.</p>
							<?php } ?>
						</div>
						
					</div>
				</div>
				<?php require_once '../templates/content_account.php'; ?>
			</div>
		</div>	
	</body>
</html>
