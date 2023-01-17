<?php 
class chess_display {
  function get_pieces($game_id) {
    $piece_query = "SELECT * FROM `chess_snapshot_pieces` WHERE `game_id` = '$game_id';";
    $mysql_piece_result = mysql_query($piece_query);
    $pieces = mysql_fetch_array($mysql_piece_result, MYSQL_BOTH);
    $remaining = $pieces['pieces'];
    for($i=0;$i<8;$i++) {
      for($j=0;$j<8;$j++) {
	$return[$i][$j] = substr($remaining, 0, 2)."<br>";
	$remaining = substr($remaining, 2);
      }
    }
    return $return;
    //return "hi";
  }
  
  function get_moves($game_id) {
    $move_query = "SELECT * FROM `chess_snapshot_moves` WHERE `game_id` = '$game_id';";
    $mysql_move_result = mysql_query($move_query);
    while ($single_move = mysql_fetch_array($mysql_move_result, MYSQL_BOTH)) {
      $return[substr($single_move['square'],0,1)][substr($single_move['square'],1,1)]=$single_move['moves'];
      //return substr($single_move['square'],1,1);
    }

        return $return;
	
  }
    
  function num_to_piecename($number) {
    switch($number){
    case 0:
      return("bking");
      break;
    case 1:
      return("bqueen");
      break;
    case 2: //left
    case 3: //right
      return("brook");
      break;
    case 4: //left
    case 5: //right
      return("bbishop");
      break;
    case 6: //left
    case 7: //right
      return("bknight");
      break;
    case 8:
    case 9:
    case 10:
    case 11:
    case 12:
    case 13:
    case 14:
    case 15:
      return("bpawn");
      break;    
    case 16:  
      return("wking");
      break;
    case 17:  
      return("wqueen");
      break;
    case 18:  
    case 19:
      return("wrook");
      break;
    case 20:
    case 21:
      return("wbishop");
      break;
    case 22:
    case 23:  
      return("wknight");
      break;
    case 24:  
    case 25:  
    case 26:  
    case 27:  
    case 28:  
    case 29:  
    case 30:  
    case 31:  
      return("wpawn");
      break;
    case 32:
      return(NULL);
      //      return(".");//just for display 
      break;
    }
  }

  function display_shell($page_content, $page_title) {
    $tplshell = new TemplatePower("templates/shell.tpl");
    $tplshell -> prepare();
    $tpltop_menu = new TemplatePower("templates/top_menu.tpl");
    $tpltop_menu -> prepare();
    
    $tplshell->assign(array(
			    "page_title" => $page_title,
			    "page_content" => $page_content,
			    "top_menu" => $tpltop_menu->getOutputContent(),
			    ));

    $tplshell->printToScreen();   
  }
}
?>