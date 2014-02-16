<?php
include "connect.inc.php";

if(isset($_POST['url'])){
	$url = $_POST['url'];
	if(!empty($url)){

		$output = '';

		$urlEx = explode(".", $url);
		$topLevelDomains = array("com","in","org","uk","tk");
		$check = 0;
		for($i=0; $i<count($topLevelDomains); $i++){
			if($urlEx[count($urlEx)-1] == $topLevelDomains[$i]){
				$check = 1;
			}
		}

		if($check){
			//If Space is allocated
			$query_run = mysql_query("SELECT * FROM `FillStatus` WHERE 1");
			$currSUrl = mysql_result($query_run, 0, 'CurrSUrl');
			$currSUrlCount = mysql_result($query_run, 0, 'sUrlAssigned');
			$lUrlAssigned = mysql_result($query_run, 0, 'lUrlAssigned');
			if(mysql_result($query_run, 0, 'lUrlAssigned') == mysql_result($query_run, 0, 'sUrlAssigned')){	
				$numbOfRows = 5;
				while($numbOfRows--){
					$sUrlSize = 6;
					while($sUrlSize--){
						if($currSUrl[$sUrlSize] != '9'){
							$temp = $currSUrl[$sUrlSize];
							$temp++;
							$currSUrl[$sUrlSize] = $temp;
							break;
						} else {
							$currSUrl[$sUrlSize] = '0';
							continue;
						}
					}
					$query_run = mysql_query("INSERT INTO `ShortenedUrls` VALUES ('','".$currSUrl."','') ");
				}
				$numbOfRows = 5;
				$query_run = mysql_query("UPDATE `FillStatus` SET `CurrSUrl`='".$currSUrl."',`sUrlAssigned`='".($currSUrlCount+$numbOfRows)."' WHERE `id`=1");
			}

			

			//Check if already present
			$query_run = mysql_query("SELECT * FROM `ShortenedUrls` WHERE `lUrl`='".$url."'");
			if(mysql_num_rows($query_run) > 0){
				$output .= "This URL is already present with us.<br/> Your shortened URL is : <a href='";
				$output .= mysql_result($query_run, 0, 'sUrl');
				$output .= "'>";
				$output .= ($_SERVER['HTTP_HOST'].'/'.mysql_result($query_run, 0, 'sUrl'));
				$output .= "</a>";
			} else {
				$query_run = mysql_query("UPDATE `ShortenedUrls` SET `lUrl`='".$url."' WHERE `id`='".($lUrlAssigned+1)."' ");
				$query_run = mysql_query("UPDATE `FillStatus` SET `lUrlAssigned`='".($lUrlAssigned+1)."' WHERE `id`=1 ");
				$output .= "Your shortened URL generated is : <a href='";
				$query_run = mysql_query("SELECT * FROM `ShortenedUrls` WHERE `id`='".($lUrlAssigned+1)."' ");
				$output .= mysql_result($query_run, 0, 'sUrl');
				$output .= "'>";
				$output .= ($_SERVER['HTTP_HOST'].'/'.mysql_result($query_run, 0, 'sUrl'));
				$output .= "</a>";
			}

		} else {
			$output = "Invalid URL Entered.";
		}

		echo $output;
	}
}
?>