<!-- START BLOCK : default -->
<form name="f" action="rough_mover.php">
<div align="center">force:<input type="radio" name="force" value="1">|<input type="radio" name="force" value="0">:legal</div>
<table border="0">
<tr>
<td valign="top">Start:
<table border="1">
<!-- START BLOCK : rowl -->
<tr>
<!-- START BLOCK : coll -->
   <td width="30", height="30"><input type="radio" name="start" value="{x}{y}"></td>
<!-- END BLOCK : coll -->
</tr>
<!-- END BLOCK : rowl -->
</table>
</td>
<td valign="top">End:
<table border="1">
<!-- START BLOCK : rowr -->
<tr>
<!-- START BLOCK : colr -->
   <td width="30", height="30" valign="center"><div align="center"><input type="radio" name="end" value="{x}{y}"></div></td>
<!-- END BLOCK : colr -->
</tr>
<!-- END BLOCK : rowr -->
</table>
</td>
</tr>
</table>
<input type="submit">
</form>
<!-- END BLOCK : default -->
