move_piece = "";  //globals
holding_moves = "";

//s = show, this is called when the mouse moves over a piece and it's moves are shown
function s(square){
	be("show", square); //call the backend function, pass what are are doing and which square
}

/*a = action, this is called when a piece is clicked
 *possible moves are held (if first click)
 */
function a(square) {
	be("action", square);
}

function o(square) {
	be("mouseout", square);

}
/*m = move, this is called when a green dot is clicked
 *refreshes the page
 */
function m(square) {
	be("move", square);
}
/*Hides all layers, a simple loop and ya, there you go, I hope
 *it won't crash if I'm hiding layers that aren't there >_<
 */
function hideall()  {
moves = report("all");
		while(moves.substring(0,2)) {
			show = moves.substring(0,2);
			document.getElementById(show).style.visibility = "hidden";
			moves = moves.substring(3,9999);
		}
}
/*be = backend, this is the function where all the work is done.
 *Because each square must have multiple mouse event handlers
 *it makes sense to have them call short function names to save space
 *I could have them call backend with the first argument being the requested action
 *(to show or to hold) but that is acually extra characters.  Fast load times
 *are very important
 */
function be(action, square) {
	if(action == "show" && move_piece == "") {
		hideall();
		moves = report(square);
		while(moves.substring(0,2)) {
			show = moves.substring(0,2);
			document.getElementById(show).style.visibility = "visible";
			moves = moves.substring(3,9999);
		}
	}
	if(action == "action") {
		if(square != move_piece) {
			move_piece = "";
			s(square);
			move_piece = square;
		}else{
			hideall();
			move_piece = "";

		}
	}
	if(action == "move") {
		alert("Moving " + move_piece + " to " + square);
	}
	if(action == "mouseout") {
		if(move_piece == "") {
			hideall();
		}
	}	
}

/*
useful stuff from snippets
substring(0,4);

indexOf("Win") != -1



*/