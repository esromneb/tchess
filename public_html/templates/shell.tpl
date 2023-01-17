<html>
<head>
<title>TChess.com - {page_title}</title>
<link href="client_include/chess_board.css" rel="stylesheet" type="text/css">
<link href="client_include/tchess.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="client_include/show_possible_moves.js">
</script>
<!-- START BLOCK : not_called -->
<script language="JavaScript" type="text/JavaScript">
<!--
function report(s) {
//this area is dynamic, the functions file is static so browser caching will speed things up
	if(s == "a3") {
		return ("a3,a5,b3");
	}
	if(s == "b3") {
		return ("c3,d3");
	}
	//report all possible layers to hide
	if(s == "all") {
		return ("a3,a4,a5,b3,c3,d3");
	}
	return(NULL);
}
//-->
</script>
<!-- END BLOCK : not_called -->
</head>
<body background="images/bg3.jpg"> 
<table border="0" align="center" width="800" cellspacing="0" cellpadding="0"> 
  <tr valign="top"> 
    <td height="13"><img src="images/upleftcorner.gif" width="13" height="13"></td> 
    <td width="774" bgcolor="#FFFFFF"></td> 
    <td height="13"><img src="images/uprightcorner.gif" width="13" height="13"></td> 
  </tr> 
  <tr> 
    <td bgcolor="#FFFFFF"></td> 
    <td bgcolor="#FFFFFF"><div align="center"> <img src="images/logo.jpg" width="373" height="108">
    {top_menu}
    <hr><br>
    {page_content}
</div>
      <p><br> 
      </p></td> 
    <td bgcolor="#FFFFFF"></td> 
  </tr> 
  <tr valign="top"> 
    <td height="13"><img src="images/downleftcorner.gif" width="13" height="13"></td> 
    <td width="774" bgcolor="#FFFFFF"></td> 
    <td height="13"><img src="images/downrightcorner.gif" width="13" height="13"></td> 
  </tr> 
</table> 
</body>
</html>
