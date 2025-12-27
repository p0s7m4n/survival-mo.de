<div id="content_account">
	<div class="text_section">
		<div class="text_section_caption">
                    	<p>Your account</p>
                </div>
		<div class="text_section_content">
			<?php
				session_start();
				if (!isset($_SESSION["user"])) { ?>
    					<p id="not_logged_message">You are not yet logged into your account.</p><form action="../scripts/login.php" method="POST"><label for="nickname">Nickname: </label><br><input type="text" name="nickname" maxlength="16"/><br><label for="password">Password: </label><br><input type="password" name="password" maxlength="16"/><br><p><input type="submit" value="Login"></p></form><form action="https://survival-mo.de/registration"><p><input type="submit" value="Register"/></p></form>
				<?php }
				else {
					$username = $_SESSION["user"]; ?>
					<p>Welcome, <b><?php echo htmlspecialchars($username)?></b>!</p>
					<p class="navi_list_item"><a href="https://survival-mo.de/profile/?u=<?php echo urlencode($username); ?>"><img src="../images/dot.png" class="navi_list_dot"> Profile</a></p>
					<p class="navi_list_item"><a href="https://survival-mo.de/profile_editor/"><img src="../images/dot.png" class="navi_list_dot"> Settings</a></p>
					<form action="../scripts/logout.php"><p><input type="submit" value="Logout"/></p></form>
				<?php }
			?>
		</div>
	</div>
</div>