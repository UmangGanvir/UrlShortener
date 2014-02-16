<?php
include "connect.inc.php";

if(isset($_GET['url'])){
	$url = $_GET['url'];
	if(!empty($url)){
		$query = "SELECT * FROM `ShortenedUrls` WHERE `sUrl`=".$url;
		if($query_run = mysql_query($query)){
			if(mysql_num_rows($query_run) == 1){
				header('Location: '.mysql_result($query_run, 0, 'lUrl'));
			}	
		}
	}
}

?>

<DOCTYPE html>
<html>
<head>
	<title>URL Shortener</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="content_div">
		<span class="content_head">Project URL-Shortener-Service</span><br/><br/>
		<input id="url" type="text" placeholder="Input URL here" /><br/><br/>
		<input id="submit_button" type="submit" value="Submit" />
	</div>
	<div class="content_div result">

	</div>
</body>
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</html>