<?php
ob_start();
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php require_once $abs_us_root.$us_url_root.'users/helpers/helpers.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/user_spice_ver.php'; ?>
<?php
//check for a custom page
$currentPage = currentPage();
if(file_exists($abs_us_root.$us_url_root.'usersc/'.$currentPage)){
	if(currentFolder()!= 'usersc'){
		Redirect::to($us_url_root.'usersc/'.$currentPage);
	}
}

$db = DB::getInstance();
$settingsQ = $db->query("Select * FROM settings");
$settings = $settingsQ->first();
if ($settings->site_offline==1){
	die("The site is currently offline.");
}

if ($settings->force_ssl==1){
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
		// if request is not secure, redirect to secure url
		$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		Redirect::to($url);
		exit;
	}
}

if($settings->track_guest == 1){
	new_user_online();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	
	
	<title>Photolib</title>

	<?php
            require_once "../newNavBar.php";
        ?>
</head>

<body>
