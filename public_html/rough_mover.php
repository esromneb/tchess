
<?php
include_once("include/include.inc.php");


$tpl = new TemplatePower("templates/rough_mover.tpl");
$tpl -> prepare();


$display = new chess_display();
if(!isset($_REQUEST['start'])) {
  $tpl->newBlock("default");
  for($y=0;$y<8;$y++) {
    $tpl->newBlock("rowl");
    for($x=0;$x<8;$x++) {
      $tpl->newBlock("coll");
      $tpl->assign(array(
			 "x" => $x,
			 "y" => $y,
			 ));
    }//for(x)
  }//for(y)
  
  for($y=0;$y<8;$y++) {
    $tpl->newBlock("rowr");
    for($x=0;$x<8;$x++) {
      $tpl->newBlock("colr");
      $tpl->assign(array(
			 "x" => $x,
			 "y" => $y,
			 ));
    }//for(x)
  }//for(y)
  $display->display_shell($tpl->getOutputContent(), "Rough piece mover");
}else{ //if(input)
  $chess = new chess_game(2);
  if($_REQUEST['force']) {
    
    $print = $chess->move(2,$_REQUEST['start'],$_REQUEST['end']);

  }else{//if(request)
    
    $print = $chess->is_move_legal($_REQUEST['start'], $_REQUEST['end']);

  }//else(request)
    print ($print);  
}//else

?>