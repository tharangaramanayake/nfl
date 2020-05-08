<?php
include("../res/x5engine.php");
$nameList = array("cce","kag","7rc","wtw","2xw","rt4","p2h","p5v","hdf","vkl");
$charList = array("H","X","P","Z","S","R","A","D","J","M");
$cpt = new X5Captcha($nameList, $charList);
//Check Captcha
if ($_GET["action"] == "check")
	echo $cpt->check($_GET["code"], $_GET["ans"]);
//Show Captcha chars
else if ($_GET["action"] == "show")
	echo $cpt->show($_GET['code']);
// End of file x5captcha.php
