<?
ini_set("include_path", ".:../:./include:../include");
include_once("include.inc.php");
$auth = new user_auth(1);

$print = $auth->SessionInc()?"they're bad<br>":"they're good<br>";
echo"page content...<br>";
print("<br>".$print);
print("access: ".$auth->access);
print("<br>required access: ".$auth->required_access);
?>