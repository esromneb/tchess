<?php
$db = mysql_connect("localhost", "tchess", "benrussiajamesjapan");
if (! $db) die("Couldn't connect to MySQL");
mysql_select_db("tchess",$db) or die("Couldn't open $db: ".mysql_error());
$_GLOBALS['db'] = $db; //set a global reference to this mysql connection ;)
?>