<?php class chess_game {

	// tchess.com/include/class.chess.game.inc.php
	// v 1.0.0 @ July 10, 2004

	var $id;    // private integer, game ID
	var $state; // board tiles array (64) [0-16 = black, 100-116 = white, 255 = NULL]
	var $moves; // variable length list of moves [even bytes are piece ID, odd are position] /// see safe moves
		// what if move contains 0x22 (")???
		// ex of safe move: 0906: black 9th peice to (1, 7)
		// ex safe move pass: 1099: white peice 0 pass pass
	var $owner; // userid of the owner
	var $time;  // time the game started
	var $pass;  // password to enter the game 
	var $slots; // number of slots per team
	var $title; // description of the game
	var $turn;  // seconds allowed per turn

	// attempt to establish a new game in the database
	// return 1 on failure, 0 on success
	function game($user, $pass, $slots, $title, $turn) {
		//*** check to make sure its ok to insert
		$state = NEW_CHESS_STATE;
		$time = time();
		$qstr  = "INSERT INTO chess_games "
			. "(state, owner, time, pass, slots, title, turn) VALUES "
			. "('$state', '$user', '$time', '$pass', '$slots', '$title', '$turn')";
		$query = mysql_query($qstr) or return 1;
		$this->game(mysql_insert_id());
	}

	// load game with game ID $id
	// return 1 on failure, 0 on success
	function game($id) {
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
	}

	function move() {
		// 0 = successful
		// 1 = passed
		if(SELECT COUNT(*) FROM game_votes WHERE game = $game AND SUBSTR(move, 1, 1) = \"\") return 1
	}

	function legal($move) {
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
	}

	function vote($move) {
		if(!legal()) return 1
		DELETE FROM chess_votes WHERE game = $game AND user = $uid
		INSERT INTO chess_votes VALUES($id, $uid, \"$move\", \"$value\")
	}

	function join($game, $user, $team) {
		$my_game = SELECT COUNT(*) FROM chess_players WHERE uid = $user
		$playing = players();
		if(!$my_game && $slots > $playing[$team])
			INSERT INTO chess_players VALUES($uid, $game, $team)
	}

	function leave($game, $uid) {
		DELETE FROM chess_players WHERE uid = $uid AND game = $game
	}

	function snapshot() {
		///***
	}

	function players() {
		//***
		$players[0] = SELECT COUNT(*) FROM chess_players WHERE game = $game AND team = 0
		$players[1] = SELECT COUNT(*) FROM chess_players WHERE game = $game AND team = 1
	}

} ?>
