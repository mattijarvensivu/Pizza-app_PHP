<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>


<form method='get' action='naytaraaka.php'>
Hae pitserian nimen tai sen osan perusteella:<br>
<input type='text' name='hakuehto' value=''>
<input type='submit' value='Hae!'>
</form>



<hr>
<?php
// mysql-pdo-search.php
 include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
 
$hakuehto = isset($_GET['hakuehto']) ? $_GET['hakuehto'] : '';
     
$stmt = haeraaka($db, $hakuehto);
sqlResult2Html($stmt);
 
// 
function haeraaka($db, $hakuehto) {
   $sql = <<<SQLEND
   SELECT raaka_aineID, nimi
   FROM Raaka_aineet WHERE nimi
   LIKE :hakuehto
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':hakuehto', "%$hakuehto%", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}
 
// SQL-kyselyn tulosjoukko HTML-taulukkoon.
function sqlResult2Html($stmt) {
 
$row_count = $stmt->rowCount();
$col_count  = $stmt->columnCount();
 
echo "Hakutulokset:" . $row_count. " riviä:<hr>\n";
echo "<table border='0'>\n";  
$output = <<<OUTPUTEND
<tr bgcolor='#ffeedd'>
<td>nimi</td>

</tr>
OUTPUTEND;
echo $output;
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $output = <<<OUTPUTEND
    <tr>
    <td>{$row['nimi']}</td>
	<td><a href='poistaraaka.php?raaka_aineID={$row['raaka_aineID']}'
	onclick="return confirm('Haluatko varmasti poistaa kohteen {$row['nimi']}?')">Poista</a></td>
	
    
   </tr>
OUTPUTEND;

    echo $output;
}
echo "</table>\n";
}