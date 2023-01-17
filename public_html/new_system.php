<?
include_once("include/include.inc.php");


$chess = new chess_game(2);


//$print = $chess->is_move_legal("40", "31");
//print ($print);

$chess->generate_move_table("01");

?>