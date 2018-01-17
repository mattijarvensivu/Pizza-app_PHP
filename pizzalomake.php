<?php
include ("navbar.php");
?>
<em>Lisää Pizza</em><form method='post' action='pizzalisaa.php'>
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Nimi</td>
  <td><input type='text' name='nimi' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Hinta euroina</td>
  <td><input type='text' name='hinta' size='30' value=''></td>
</tr>

</table>
<input type='submit' name='action' value='Tallenna' onclick="javascript: return confirm('Hyväksy lisäys?')"><br>
</form>