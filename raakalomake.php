<?php
include ("navbar.php");
?>
<em>Lisää Raaka-aine</em><form method='post' action='raakalisaa.php'>
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Nimi</td>
  <td><input type='text' name='nimi' size='30' value=''></td>
</tr>


</table>
<input type='submit' name='action' value='Tallenna' onclick="javascript: return confirm('Hyväksy lisäys?')"><br>
</form>