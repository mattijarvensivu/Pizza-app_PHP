
	


<?php
session_start();
if(isset($_SESSION['logged'])){
if($_SESSION['logged']=="admin"){
	
	
echo"<style type='text/css'>";
echo"tr:nth-child(odd) {background: #f1f1f1}";
echo"tr:nth-child(even) {background: #ffffff}";
echo"tr:nth-child(1) {background: #ffeedd}";
echo"</style>";


echo"<form method='get' action='naytapizzat.php'>";
echo"Hae pitserian nimen tai sen osan perusteella:<br>";
echo"<input type='text' name='hakuehto' value=''>";
echo"<input type='submit' value='Hae!'>";
echo"</form>";
echo"<hr>";
	
	
	
	
	
	
	
 include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
 
$hakuehto = isset($_GET['hakuehto']) ? $_GET['hakuehto'] : '';
     
function haeHenkilot($db, $hakuehto) {
   $sql = <<<SQLEND
   SELECT pizzaID, nimi, hinta
   FROM Pizza WHERE nimi
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
<td>nimi</td><td>hinta</td>

</tr>
OUTPUTEND;
echo $output;
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $output = <<<OUTPUTEND
    <tr>
    <td><a href='raakalista.php?pizzaID={$row['pizzaID']}'>{$row['nimi']}</a></td><td>{$row['hinta']}</td>
	<td><a href='poistapizza.php?pizzaID={$row['pizzaID']}'
	onclick="return confirm('Haluatko varmasti poistaa kohteen {$row['nimi']}?')">Poista</a></td>
	
    
   </tr>
OUTPUTEND;

    echo $output;
}
echo "</table>\n";
}
$stmt = haeHenkilot($db, $hakuehto);
sqlResult2Html($stmt);
}
	}else {echo "Kirjaudu sisään ensin";
echo"<br>";
?><img src="snoop.gif"style="width:150px;height:200px"><?php
echo "<a href='index.php'>Kirjaudu tästä</a>";
}