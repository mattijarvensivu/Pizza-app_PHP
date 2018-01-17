
<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>



<hr>
<?php
// mysql-pdo-search.php
 include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
 session_start();
$id = isset($_GET['pizzaID']) ? $_GET['pizzaID'] : ' ei mitaan';


     
$stmt = haeraaka($db, $id);
$stmt2 = haekaikkiraaka($db, $id);
sqlResult2Form($stmt);
sqlResult2Form2($stmt2);
 $_SESSION['id']= $id;
// 
function haeraaka($db, $id) {
  $sql = <<<SQLEND
SELECT piz.nimi, raaka.*
FROM Raaka_aineet raaka
INNER JOIN Pizza_Raaka_aineet pira ON pira.raaka_aineID = raaka.raaka_aineID
INNER JOIN Pizza piz ON piz.pizzaID = pira.pizzaID
WHERE pira.pizzaID=$id

SQLEND;


 
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}

function haekaikkiraaka($db, $id)

 {
 $sql = <<<SQLEND
SELECT raaka_aineID,nimi
FROM Raaka_aineet 

SQLEND;

   $stmt2 = $db->prepare($sql);
   $stmt2->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt2->execute();
   return $stmt2;    
}
 
// SQL-kyselyn tulosjoukko HTML-taulukkoon.
function sqlResult2Form($stmt) {
 

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
	<td><a href='poistaraaka_pizzasta.php?raaka_aineID={$row['raaka_aineID']}'
	onclick="return confirm('Haluatko varmasti poistaa kohteen {$row['nimi']}?')">Poista</a></td>
    
   </tr>
OUTPUTEND;
    echo $output;
}
echo "</table>\n";
}
function sqlResult2Form2($stmt2) 

{
$options='';

while($row = $stmt2->fetch(PDO::FETCH_ASSOC))
{
 $options .="<option>" . $row['nimi'] . "</option>";
}

$menu="<form  method='POST' action='lisaaraaka_pizzaan.php'  name='raaka' >
  <p><label>Lisaa Raaka-aine</label></p>
    <select name='raaka'>
      " . $options . "
    </select>
 <input type=submit value=Lisää>
</form>";


echo $menu;
if(isset($_POST['raaka'])){
$_POST['raaka'];
 
}

}




 
?>