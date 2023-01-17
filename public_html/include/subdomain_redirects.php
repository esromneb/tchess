<?
if($_SERVER['HTTP_HOST'] == "tchess.com") {
  header('Location: http://www.tchess.com/');
  die;
}
if($_SERVER['HTTP_HOST'] == "forum.tchess.com") {
  header('Location: http://www.tchess.com/forum/');
  die;
}
?>