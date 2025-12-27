<?php

session_start();

if(!isset($_SESSION["user"])){
	header("Location: https://survival-mo.de");
	exit();
} else {
	$user = $_SESSION["user"];
}

$user_data = json_decode(file_get_contents("../.users_data/users/$user"));

$user_country = $user_data->country;
$user_timezone = $user_data->timezone;
$user_bio = $user_data->bio;
$user_fav_pers = $user_data->fav_pers;
$user_fav_level = $user_data->fav_level;
$user_discord = $user_data->discord;
$user_website = $user_data->website;

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require_once '../templates/head.php';  ?>
		<title>SURVIVAL MODE :: Profile Editor</title>
	</head>
	<body>
		<?php require_once '../templates/sky.php';  ?>	
		<div id="page">
			<?php require_once '../templates/header.php'; ?>
			<?php
				if(isset($_GET["e"])){
					if($_GET["e"] == 1){
						echo '<p class="error">Given website link is not valid.</p>';
					}
					else {
						header("Location: https://survival-mo.de/profile_editor");
						exit();
					}
				}
			?>

			<div id="content">
				<?php require_once '../templates/content_nav.php'; ?>
				<div id="content_main">
					<div class="text_section">
						<div class="text_section_caption">
							<p>Profile editor</p>
						</div>
						<div class="text_section_content">
						<form action="../scripts/edit_profile.php" method="POST" id="profile_edit_form">
							<dl class="form_dl">	
								<dt><label for="country">Country:</label></dt>
								<dd>
									<select name="country" form="profile_edit_form">
										<option value="">[Select]</option>
										<?php
										$options = array("Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, The Democratic Republic of The", "Cook Islands", "Costa Rica", "Cote D'ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-bissau", "Guyana", "Haiti", "Heard Island and Mcdonald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran, Islamic Republic of", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint Vincent and The Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and The South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Timor-leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam", "Virgin Islands, British", "Virgin Islands, U.S.", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
										foreach ($options as $option) {
      											$selected = ($user_country === $option) ? 'selected' : '';
      											echo "<option value=\"".htmlspecialchars($option, ENT_QUOTES)."\" $selected>$option</option>";
    										}
    										?>
  									</select>
								</dd>
								<dt><label for="timezone">Timezone:</label></dt>
								<dd>
									<select name="timezone" form="profile_edit_form">
										<option value="">[Select]</option>
										<?php 
											foreach (array("-24" => "GMT - 12", "-22" => "GMT - 11", "-20" => "GMT - 10", "-18" => "GMT - 9", "-16" => "GMT - 8", "-14" => "GMT - 7", "-12" => "GMT - 6", "-10" => "GMT - 5", "-8" => "GMT - 4", "-7" => "GMT - 3:30", "-6" => "GMT - 3", "-4" => "GMT - 2", "-2" => "GMT - 1", "0" => "GMT", "2" => "GMT + 1", "4" => "GMT + 2", "6" => "GMT + 3", "7" => "GMT + 3:30", "8" => "GMT + 4", "9" => "GMT + 4:30", "10" => "GMT + 5", "11" => "GMT + 5:30", "12" => "GMT + 6", "13" => "GMT + 6:30", "14" => "GMT + 7", "16" => "GMT + 8", "18" => "GMT + 9", "19" => "GMT + 9:30", "20" => "GMT + 10", "22" => "GMT + 11", "24" => "GMT + 12", "26" => "GMT + 13") as $value => $display) echo "<option value=\"$value\"" . ($user_timezone == $value ? ' selected' : '') . ">".htmlspecialchars($display, ENT_QUOTES)."</option>";
										?>
									</select>
								</dd>
								<dt><label for="fav_level">Favorite Supercow level:</label></dt>
								<dd>
									<select name="fav_level" form="profile_edit_form">
										<option value="">[Select]</option>
										<?php 
											foreach (array("1-1","1-2","1-3","2-1","2-2","2-3","2-4","3-1","3-2","3-3","3-4","3-5","4-1","4-2","4-3","4-4","4-5","5-1","5-2","5-3","5-4","5-5","6-1","6-2","6-3","6-4","6-5","7-1","7-2","7-3","7-4","7-5","8-1","8-2","8-3","8-4","8-5","9-1","9-2","9-3","9-4","9-5","10-1","10-2","10-3","10-4","10-5") as $value) echo "<option value=\"$value\"" . ($user_fav_level == $value ? ' selected' : '') . ">".htmlspecialchars($value, ENT_QUOTES)."</option>"; 
										?>
									</select>
								</dd>
								<dt><label for="fav_pers">Favorite Supercow character:</label></dt>
								<dd>
									<select name="fav_pers" form="profile_edit_form">
										<option value="">[Select]</option>
										<?php 
											foreach (array("Supercow","Professor Duriarti","Molly the Sheep","Jim the Donkey","Kevin the Goose","Maggie the Chicken","Nick the Chick","Mark the Rabbit","Allie the Turkey","Bob the Pig","Roger the Goat","Bill the Bull") as $value) echo "<option value=\"$value\"" . ($user_fav_pers == $value ? ' selected' : '') . ">".htmlspecialchars($value, ENT_QUOTES)."</option>"; 
										?>
									</select>
								</dd>
								<dt><label for="discord">Discord:</label></dt>
								<dd>
									<input type="text" form="profile_edit_form" value="<?php echo htmlspecialchars($user_discord, ENT_QUOTES); ?>" name="discord">
								</dd>
								<dt><label for="website">Website:</label></dt>
								<dd>
									<input type="text" form="profile_edit_form" value="<?php echo htmlspecialchars($user_website, ENT_QUOTES); ?>" name="website">
								</dd>


							</dl>
							<p><input type="submit" value="Submit"></p>
                				</form>

						</div>
					</div>
				</div>
				<?php require_once '../templates/content_account.php';  ?>
			</div>
		</div>
	</body>
</html>
