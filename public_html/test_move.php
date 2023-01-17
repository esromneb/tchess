<?
include_once("include/include.inc.php");


$chess = new chess_game();


$print = $chess->move(2,76,74);
print ($print);