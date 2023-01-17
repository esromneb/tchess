<?php

include_once("class.TemplatePower.inc.php");

$tpl = new TemplatePower("table.tpl");
$tpl->prepare();

for($i = 0; $i < 8; $i++) {
	$tpl->newBlock ("row");
	for($j = 0; $j < 8; $j++) {
		$tpl->newBlock ("col");
		$tpl->assign(array("i" => "<img src='images/chess/" . rand(0, 255) . "'>"));
	}
}

$tpl->printtoScreen();

?>
