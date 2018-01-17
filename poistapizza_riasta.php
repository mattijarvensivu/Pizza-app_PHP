<?php
include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
session_start();
$pizzaid = isset($_GET['pizzaID']) ? $_GET['pizzaID'] : ' ei mitaan';
$pizzeriaid = $_SESSION['id'];

$stmt=poistapizza($db, $pizzeriaid,$pizzaid);

 

function poistapizza($db, $pizzeriaid,$pizzaid) {
 $sql = <<<SQLEND
DELETE FROM Pizzeria_Pizza
WHERE pizzeriaID= $pizzeriaid AND pizzaID=$pizzaid
SQLEND;
 
 
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':pizzeriaid', "$pizzeriaid", PDO::PARAM_STR);
   $stmt->execute();
     


 return $stmt;   
}

echo "<a href= http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/pitsalista.php?pizzeriaID=$pizzeriaid >Palaa<a/>";
echo "Poisto onnistui";
?>