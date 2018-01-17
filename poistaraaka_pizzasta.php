<?php
include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
session_start();
$raakaid = isset($_GET['raaka_aineID']) ? $_GET['raaka_aineID'] : ' ei mitaan';
$pizzaid = $_SESSION['id'];

$stmt=poistaraaka($db, $pizzaid,$raakaid);

 

function poistaraaka($db, $pizzaid,$raakaid) {
 $sql = <<<SQLEND
DELETE FROM Pizza_Raaka_aineet
WHERE pizzaID= $pizzaid AND raaka_aineID=$raakaid
SQLEND;
 
 
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':pizzaID', "$pizzaid", PDO::PARAM_STR);
   $stmt->execute();
     


 return $stmt;   
}

echo "<a href= http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/raakalista.php?pizzaID=$pizzaid >Palaa<a/>";
echo "Poisto onnistui";
?>