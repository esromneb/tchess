<?php
include_once("include/include.inc.php");
$tplshell = new TemplatePower("templates/shell.tpl");
$tplshell -> prepare();
$tplcontent = new TemplatePower("templates/template_two.tpl");
$tplcontent -> prepare();
$tpltop_menu = new TemplatePower("templates/top_menu.tpl");
$tpltop_menu -> prepare();

$tplshell->assign(array(
			"page_title" => "Template Two",
			"page_content" => $tplcontent->getOutputContent(),
			"top_menu" => $tpltop_menu->getOutputContent(),
			));
$display = new chess_display();
$test = $display->num_to_piecename(0);
//print("$test");

$tplshell->printToScreen();
?>