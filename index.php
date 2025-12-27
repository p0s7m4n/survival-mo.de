<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require_once './templates/head.php';  ?>
		<title>SURVIVAL MODE :: Home</title>
	</head>
	<body>
		<?php require_once './templates/sky.php';  ?>	
		<div id="page">
			<?php require_once './templates/header.php'; ?>
			<?php
				if(isset($_GET["e"])){
					if($_GET["e"] == 1){
						echo '<p class="error">Nickname and/or password cannot be empty.</p>';
					}
					else if($_GET["e"] == 2){
						echo '<p class="error">User does not exist.</p>';
					}
					else if($_GET["e"] == 3){
						echo '<p class="error">Password is wrong.</p>';
					}
					else if($_GET["e"] == 4){
						echo '<p class="error">User not found.</p>';
					}

					else {
						header("Location: https://survival-mo.de");
					}
				}
			?>
			<div id="content">
				<?php require_once './templates/content_nav.php'; ?>
				<div id="content_main">
					<div class="text_section">
						<div class="text_section_caption">
							<p>Website info</p>
						</div>
						<div class="text_section_content">
						<p><b>Survival Mode</b> is a community website dedicated to modding of the game Supercow. Here you can
							find mods,
							as well as various instruments for modification and other useful files related to the game.
						</p>
						</div>
					</div>
					<div class="text_section">
						<div class="text_section_caption">
							<p>Game info</p>
						</div>
						<div class="text_section_content">
						<blockquote>
							<p>Professor Duriarti, a famous criminal, has seized the farm and captured the animals! He
								cloned them and made the clones work for him to successfully fulfill his diabolical plan of earth's
								destruction. Through her network of informants, Supercow heard about the situation, and dashed off
								to save the farm animals. Because after all, who knows how to save the farm better than Supercow?
							</p>
							<cite>- Big Fish Games page description</cite>
						</blockquote>
						<p><b>Supercow</b> is a platformer by Russian developer Nevosoft, released in 2007. The game has 47
							levels in
							total and combines colorful 2D and 3D graphics. It was in development for 2 years and eventually
							became very popular in the post-Soviet countries and the most successful game of the developer.
						</p>
						</div>
					</div>
					<div class="text_section">
						<div class="text_section_caption">
							<p>Community</p>
						</div>
						<div class="text_section_content">
						<p>
							<b>Super Cow Cowmoonity</b> is a discord server that brings together fans of the game. There you can
							get
							help from knowledgeable members, learn more about the game or just talk about Supercow and other
							topics.<br>
						<form action="https://discord.supercow.community">
							<input type="submit" value="Join the server"/>
						</form>
						</p>
						</div>
					</div>
				</div>
				<?php require_once './templates/content_account.php';  ?>
			</div>
		</div>
	</body>
</html>