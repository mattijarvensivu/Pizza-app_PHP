<?php
include ("navbar.php");
?>
<em>Lis‰‰ osoite</em><form method='post' action='pizzerialisaa.php'>
<table border='0' cellpadding='5'>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Nimi</td>
  <td><input type='text' name='nimi' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Osoite</td>
  <td><input type='text' name='osoite' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Aukiolo</td>
  <td><input type='text' name='aukiolo' size='30' value=''></td>
</tr>
<tr valign='top'>
  <td align='right' bgcolor='#ffeedd'>Kotiinkuljetus</td>
  <td><input type="checkbox" name='kotiinkuljetus' size='50'  value=1></td>
</tr>

</table>
<input type='submit' name='action' value='Tallenna' onclick="javascript: return confirm('Hyv‰ksy lis‰ys?')"><br>
</form>