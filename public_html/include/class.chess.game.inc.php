<?php class chess_game {


	// tchess.com/include/class.chess.game.inc.php
	// v 1.0.0 @ July 10, 2004

  //	var $id;    // private integer, game ID
  //	var $state; // board tiles array (64) [0-16 = black, 100-116 = white, 255 = NULL]
  //	var $moves; // variable length list of moves [even bytes are piece ID, odd are position] /// see safe moves
		// what if move contains 0x22 (")???
		// ex of safe move: 0906: black 9th peice to (1, 7)
		// ex safe move pass: 1099: white peice 0 pass pass
  //	var $owner; // userid of the owner
  //	var $time;  // time the game started
  //	var $pass;  // password to enter the game 
  //	var $slots; // number of slots per team
  //	var $title; // description of the game
  //	var $turn;  // seconds allowed per turn
	var $piece_array;  //Array of all the pieces check to see if set each time called.  If not run set_piece_array()
	var $move_array;
	var $game_id;
	// attempt to establish a new game in the database
	// return 1 on failure, 0 on success
	function chess_game($game_id) {
	  if($this->set_piece_array($game_id)) {
	    die("set_piece_array() puked");
	  }
	  $this->game_id = $game_id;
	}
	function game($user, $pass, $slots, $title, $turn) {
		//*** check to make sure its ok to insert
	  /*
		$state = NEW_CHESS_STATE;
		$time = time();
		$qstr  = "INSERT INTO chess_games "
			. "(state, owner, time, pass, slots, title, turn) VALUES "
			. "('$state', '$user', '$time', '$pass', '$slots', '$title', '$turn')";
		$query = mysql_query($qstr) or return 1;
		$this->game(mysql_insert_id());
	  */
	}

	// load game with game ID $id
	// return 1 on failure, 0 on success
	function game($id) {
	  /*
		$query = mysql_query("SELECT * FROM chess_games WHERE id = $id");
		$row = mysql_fetch_object($query) or return 1;
		$this->id    = $row->id;
		$this->state = $row->state;
		$this->moves = $row->moves;
		$this->owner = $row->owner;
		$this->time  = $row->time;
		$this->pass  = $row->pass;
		$this->slots = $row->slots;
		$this->title = $row->title;
		$this->turn  = $row->turn;
		return 0;
	  */
	}
	// 0 = successful
	// 1 = move not valid (somebody hacked html or we're fucked, one of the two)
	//move(2, 10, 22)   (moves black knight out from behind pawns)
	function move($game_id, $starting, $ending) {
	  //select all pieces on the board and parse into nice little array
	  $select_pieces_query = "SELECT * FROM `chess_snapshot_pieces` WHERE `game_id` = '$game_id';";
	  $select_pieces_result = mysql_query($select_pieces_query);
	  $pieces = mysql_fetch_array($select_pieces_result, MYSQL_BOTH);
	  $remaining = $pieces['pieces']; // $remaining = remianing pieces to parse into array
	  for($y=0;$y<8;$y++) {
	    for($x=0;$x<8;$x++) {
	      $piece_array[$x][$y] = substr($remaining, 0, 2); // $piece_array holds each piece id at the corrosponding x,y
	      $remaining = substr($remaining, 2);
	    }
	  }
	  $moving_piece_id = $piece_array[substr($starting,0,1)][substr($starting,1,1)]; //piece_id of the piece that's moving

	  if($moving_piece_id == 32) { // if trying to move from a blank space DIE
	    return 1;
	  }
	  $piece_array[substr($ending,0,1)][substr($ending,1,1)] = $moving_piece_id; //effectivly copy and paste the piece from it's old space to it's new one
	  $piece_array[substr($starting,0,1)][substr($starting,1,1)] = "32"; //fill in the blank space ;)
	  $new_snapshot = ""; //create the new snapsnot
	  for($y=0;$y<8;$y++) { //do the opposite of the loop above and unwind the array back into a string
            for($x=0;$x<8;$x++) {
	      $new_snapshot .= $piece_array[$x][$y];
	    }
	  }
	  $update_pieces_query = "UPDATE `chess_snapshot_pieces` SET `pieces` = '".$new_snapshot."' WHERE `game_id` = '".$game_id."' LIMIT 1;";  //update mysql with new snapshot of pieces
	  mysql_query($update_pieces_query);
	  $get_move_history_query = "SELECT `moves` FROM `chess_games` WHERE `id` = '".$game_id."' LIMIT 1;"; //get move history
	  $get_move_history_result = mysql_query($get_move_history_query);
	  $chess_game = mysql_fetch_array($get_move_history_result);
	  $update_move_history_query = "UPDATE `chess_games` SET `moves` = '".$chess_game['moves'].$starting.$ending."' WHERE `id` = '".$game_id."' LIMIT 1;"; //add the last move to the history and send it back to mysql
	  mysql_query($update_move_history_query);

	  return 0;
	  //		if(SELECT COUNT(*) FROM game_votes WHERE game = $game AND SUBSTR(move, 1, 1) = \"\") return 1
	}
	


	//log_error("class.chess.game.inc.php", 37, "snapshot: ; userid: ; ip: ;", "Black moved white's pieces");
	function log_error($source_file, $game_id, $addtional_info, $error) {
	  ;
	}
	function on_board($position) {
	  $position_x = substr($position,0,1);
          $position_y = substr($position,1,1);
	  if(($position_x > 7 || $position_x < 0) || ($position_y > 7 || $position_y < 0)){
	    return 0;
	  }else{
	    return 1;
	  }
	}
	function get_color($coords, $type=0) {
	  switch($piece_id = $this->piece_array[substr($coords,0,1)][substr($coords,1,1)]) {
	  case ($piece_id <= 15):
	    if($type == 0) {
	      return 0; //black
	    }else{
	      return 'b';
	    }//else(type)
	    break;
	  case ($piece_id > 16 && $piece_id < 32):
	    if($type == 0) {
	      return 1; //white
	    }else{
	      return 'w';
	    }//else(type)
	    break;
	  case (32):
	    if($type == 0) {
	      return 2; //space
	    }else{
	      return 's';
	    }//else(type)
	    break;
	  }//switch
	}//get_color

	//return 0, no
	//return 1, yes is valid
	function is_move_legal($starting, $ending) {
	  if($starting == $ending) { // all moves must be checked to see if
	    return 0;
	    die("starting and ending the same"); // they are starting and ending in the same place
	  }
	  $starting_x = substr($starting,0,1);
	  $starting_y = substr($starting,1,1);
	  $ending_x = substr($ending,0,1);
	  $ending_y = substr($ending,1,1);
	  if(!$this->on_board($starting)){ // if they are even on the board!
	    return 0;
	    die("start move not on board");
	  }//if()
	  if(!$this->on_board($ending)) { // if they are crazy and trying to leave the board
	    return 0;
	    die("end not on board $ending");
	  }//if()

	  if($this->piece_array[substr($starting,0,1)][substr($starting,1,1)] == 32) {
	    return 0;
	    die("trying to move from blank space");
	  }//if()


	  switch($piecename = $this->num_to_piecetype($this->piece_array[substr($starting,0,1)][substr($starting,1,1)])) {
	  case 'wking':
	  case 'bking':
	    if((abs($starting_x - $ending_x) >= 2 ) || (abs($starting_y - $ending_y) >= 2)) { 
	      // the king can only move one space, so the |startx - endx| can't be more than one, same for y
	      return 0;
	      die("$piecename moving more than 1 square");
	    }//if(abs,x,y)
	    if($this->get_color($starting) == $this->get_color($ending)) {
	      return 0;
	      die("$piecename moving to square with piece of same color");
	    }//if(color)
	    return 1;
	    break;
	  case 'bpawn':
	  case 'wpawn':
	    if($this->get_color($starting)) { //0 = black, 1 = white
	      $direction = -1; //we are moving negative
	    }else{
	      $direction = 1;
	    }//if(color)
	    if($starting_y == (3.5 + ( -2.5 * $direction ))) {  //equals either 1 or 6 which are starting y for pawn
	      $movement = 2;
	    }else{
	      $movement = 1;
	    }
	    //print("movement = $movement<br>direction = $direction<br>1 or 6 = ".(3.5 + ( -2.5 * $direction ))."<br>");
	    if(
	       (( $ending_y - $starting_y ) * $direction ) <= $movement
	       && ( $starting_x == $ending_x )
	       && $this->get_color($ending, 1) == "s"
	       ) { 
	      //	      print("starting out, OR just moving straight 1 space, NOT attacking<br>");
	    }else{
	      if(( $ending_y - $starting_y * $direction ) == 1) {
		if(
		   ( ( $starting_x == $ending_x ) && $this->get_color($ending, 1) == "s" )
		   || ( 
		       abs($starting_x - $ending_x) == 1 
		       && $this->get_color($ending,1) != "s"
		       && $this->get_color($starting) != $this->get_color($ending)
		       )
		   ) {
		  //		  die("ok");
		}else{ //if(straight and blank || |start_x - end_x| == 1 and end_x == opposite color)
		  return 0;
		  die("no good");
		}//else
	      }else{//if(movement == 1)
		return 0;
		die("no good");
	      }
	    }//if(not attacking and moving 1 or 2 spaces)
	    return 1;
	    break;

	  }//switch()
	  print($this->num_to_piecetype($this->piece_array[substr($starting,0,1)][substr($starting,1,1)]).$starting.$ending);
	  return 0; //by this point, we should have gotten a positive, or not, die
	  /*
			is origin/dest on board
			is peice there at origin
			is path legal:
				pawn
					1st move
					takeing?
					normal
				rook
					castle
					normal
				hourse
				bishop
				queen
				king
	  */
	
	}//is_move_legal()
	/*
	 *Returns an array[x][y] such that the coords contain the piece id of the piece that's there
	*/
  function set_piece_array($game_id) {
    $piece_query = "SELECT * FROM `chess_snapshot_pieces` WHERE `game_id` = '$game_id';";
    $mysql_piece_result = mysql_query($piece_query);
    $pieces = mysql_fetch_array($mysql_piece_result, MYSQL_BOTH);
    $remaining = $pieces['pieces'];
    for($i=0;$i<8;$i++) {
      for($j=0;$j<8;$j++) {
	$this->piece_array[$j][$i] = substr($remaining, 0, 2);//."<br>";
	$remaining = (string)substr($remaining, 2);
      }
    }
    if(isset($this->piece_array)) {
      return 0;
    }else{
      return 1;
    }
  }
  /*
   *Returns an array[x][y] containing the move string
   */
  function set_move_array($game_id) {
    $move_query = "SELECT * FROM `chess_snapshot_moves` WHERE `game_id` = '$game_id';";
    $mysql_move_result = mysql_query($move_query);
    while ($single_move = mysql_fetch_array($mysql_move_result, MYSQL_BOTH)) {
      $this->move_array[substr($single_move['square'],0,1)][substr($single_move['square'],1,1)]=$single_move['moves'];
      //return substr($single_move['square'],1,1);
    }
    if(isset($this->move_array)) {
      return 0;
    }else{
      return 1;
    }

  }
  function generate_move_table($piece_coords) {
    $valid_moves = "";
    for($y=0;$y<8;$y++) {
      for($x=0;$x<8;$x++) {
	if($this->is_move_legal($piece_coords, $x.$y)) {
	  $valid_moves = $valid_moves.$x.$y; //+= gives us ints
	}
      }//for(x)
    }//for(y)    
    print($valid_moves);
  }
  function num_to_piecetype($number) {
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
      //return(NULL); //don't know why I thought this would work??
      return("space");
      break;
    }
  }


	function vote($move) {
	  /*
		if(!legal()) return 1
		DELETE FROM chess_votes WHERE game = $game AND user = $uid
		INSERT INTO chess_votes VALUES($id, $uid, \"$move\", \"$value\")
	  */
	}

	function join($game, $user, $team) {
	  /*
		$my_game = SELECT COUNT(*) FROM chess_players WHERE uid = $user
		$playing = players();
		if(!$my_game && $slots > $playing[$team])
			INSERT INTO chess_players VALUES($uid, $game, $team)
	  */
	}

	function leave($game, $uid) {
	  /*
		DELETE FROM chess_players WHERE uid = $uid AND game = $game
	  */
	}

	function snapshot() {
		///***
	}

	function players() {
		//***
	  /*
		$players[0] = SELECT COUNT(*) FROM chess_players WHERE game = $game AND team = 0
		$players[1] = SELECT COUNT(*) FROM chess_players WHERE game = $game AND team = 1
	  */
	}

} ?>
