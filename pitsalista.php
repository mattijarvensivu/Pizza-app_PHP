
<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>



<hr>
<?php

include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
session_start();
 
$id = isset($_GET['pizzeriaID']) ? $_GET['pizzeriaID'] : ' ei mitaan';


$stmt = haepizzat($db, $id);
$stmt2 = haekaikkipizzat($db);
sqlResult2Form2($stmt2);

sqlResult2Form($stmt);

$_SESSION['id']=$id;




function haepizzat($db, $id)
 {
 $sql = <<<SQLEND
SELECT pizze.nimi, pizza.*
FROM Pizza pizza
INNER JOIN Pizzeria_Pizza pipi ON pipi.pizzaID = pizza.pizzaID
INNER JOIN Pizzeria pizze ON pizze.pizzeriaID = pipi.pizzeriaID
WHERE pipi.pizzeriaID=$id

SQLEND;
 
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}




function haekaikkipizzat($db)

 {
 $sql = <<<SQLEND
SELECT pizzaID,nimi
FROM Pizza 

SQLEND;

   $stmt2 = $db->prepare($sql);
   $stmt2->execute();
   return $stmt2;    
}
 

 
 
 
function sqlResult2Form($stmt)
 {
 

echo "<table border='0'>\n";


$output = <<<OUTPUTEND
<tr bgcolor='#ffeedd'>
<td>nimi</td><td>Hinta</td>
</tr>
OUTPUTEND;
echo $output;

 
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
    $output = <<<OUTPUTEND
    <tr>
    <td><a href='raakalista.php?pizzaID={$row['pizzaID']}'>{$row['nimi']}</a></td><td>{$row['hinta']}</td>
	<td><a href='poistapizza_riasta.php?pizzaID={$row['pizzaID']}'
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

$menu="<form  method='POST' action='lisaapizza_riaan.php'  name='pizza' >
  <p><label>Lisaa Pizza</label></p>
    <select name='pitsa'>
      " . $options . "
    </select>
 <input type=submit  value=Lisää>
</form>";


echo $menu;
if(isset($_POST['pitsa'])){
$_POST['pitsa'];
 
}

}




