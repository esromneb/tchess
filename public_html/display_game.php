<?php
include_once("include/include.inc.php");


$tpl = new TemplatePower("templates/display_game.tpl");
$tpl -> prepare();


$display = new chess_display();
$piece_array = $display->get_pieces("2");
$move_array = $display->get_moves("1");
//print($piece_array[5][0]);
for($y=0;$y<8;$y++) {
  $tpl->newBlock("row");
  for($x=0;$x<8;$x++) {
    if(1) {
      $img_mouse_over = " onMouseOver=\"s('$x$y')\" onClick=\"a('$x$y')\" onMouseOut=\"o('$x$y')\"";
    }
    $tpl->newBlock("col");
    $tpl->assign(array(
		       //does a very complicated check against the piece names from the multi
		       //dimensional array.  If the return is true, it gets saved for quick reference
		       //so $this_piece is just calld again instead of the whole thing
		       "square_html" => ($this_piece = $display->num_to_piecename($piece_array[$x][$y])) ? '<span style="position:relative; top:0; left:0; z-index:1">'."<img src=\"images/pieces/".$this_piece.".gif\"$img_mouse_over>".'</span>' : "",
		       //		       "onclick" => ($move_array[$x][$y] == "")?"":' onClick="alert('.$move_array[$x][$y].');"',
		       "first_td" => ($x)? "" :" height=\"49\"",
		       "square_class" => (($y%2) xor ($x%2))?"b":"w",
		       //"green_dot" => '<span id="'.$x.$y.'" style="z-index:2; position:absolute; top:0; left:0; visibility:hidden;"><img src="images/green_dot2.gif" '."onClick=\"m('$x$y')\"></span>",
		       "green_dot" => ($y==1 || $x==3 || $y==2)?'<span id="'.$x.$y.'" style="z-index:2; position:absolute; top:0; left:0; visibility:hidden;"><img src="images/green_dot2.gif"'."></span>" : "",
		       ));
  }
}

$display->display_shell($tpl->getOutputContent(), "Negative Beta Stage >_<");
//$tpl->printtoScreen();
//		       "square_html" => ($this_piece = $display->num_to_piecename($piece_array[$x][$y]))"images/pieces/".$display->num_to_piecename($piece_array[$x][$y]).".gif" ? "",
?>