<script language="JavaScript" type="text/JavaScript">
<!--
function report(s) {
//this area is dynamic, the functions file is static so browser caching will speed things up
switch(s) {
case '30': return('3132'); break
//case 'b3': 'c3,d3'; break
//case 'all': 'a3,a4,a5,b3,c3,d3'; break
case 'all': return('3132'); break
}

}
//-->
</script>
<table border="0" class="chess_board" cellspacing="0" cellpadding="0">
<!-- START BLOCK : row -->
<tr>
<!-- START BLOCK : col -->
<td{first_td} width="49" class="{square_class}"{onclick} style="position:relative"><div style="position:relative">{square_html}{green_dot}</div></td>
<!-- END BLOCK : col -->
</tr>
<!-- END BLOCK : row -->
</table>
<!-- START BLOCK : not_called -->
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


<!-- END BLOCK : not_called -->
