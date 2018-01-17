<?php

include ("navbar.php");
require_once("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
$id = isset($_GET['raaka_aineID']) ? $_GET['raaka_aineID'] : ' ei mitaan';


$stmt=poistapizza($db, $id);

 

function poistapizza($db, $id) {
 $sql = <<<SQLEND
DELETE FROM Raaka_aineet
WHERE raaka_aineID= :id;
SQLEND;
$sql3 = <<<SQLEND
DELETE FROM Pizza_Raaka_aineet
WHERE raaka_aineID = :id;
SQLEND;
$stmt2 = $db->prepare($sql3);
   $stmt2->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt2->execute();


   $stmt = $db->prepare($sql);
   $stmt->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt->execute();
     


 return $stmt;   
}
echo "<a href= http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/naytaraaka.php>Palaa<a/>";
echo "Poisto onnistui";
?>