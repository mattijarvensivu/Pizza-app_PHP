<?php
include ("navbar.php");
require_once("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
$id = isset($_GET['pizzeriaID']) ? $_GET['pizzeriaID'] : ' ei mitaan';
$stmt=poistapizzeria($db, $id);

 

function poistapizzeria($db, $id) {
 $sql = <<<SQLEND
DELETE FROM Pizzeria
WHERE pizzeriaID= :id;
SQLEND;
$sql2 = <<<SQLEND
DELETE FROM Pizzeria_Pizza
WHERE pizzeriaID = :id;
SQLEND;

 $stmt2 = $db->prepare($sql2);
   $stmt2->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt2->execute();
 
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt->execute();
     


 return $stmt;   
}


?>


