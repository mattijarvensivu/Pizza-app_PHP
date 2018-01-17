<?php
include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
session_start();

$valittupitsa = $_POST['pitsa'];

$pitseriaID = $_SESSION['id'];

 
echo $pitseriaID;


$st = $db->prepare("SELECT pizzaID FROM Pizza WHERE nimi = :nimi");
$st->bindValue(":nimi", "$valittupitsa", PDO::PARAM_STR);
$st->execute();
$row = ($st->fetch(PDO::FETCH_ASSOC));
$pizzaid=$row["pizzaID"];


$sql = <<<SQLEND
INSERT INTO Pizzeria_Pizza (pizzaID,pizzeriaID)
VALUES(:f1,:f2)
SQLEND;
 
$stmt = $db->prepare("$sql");
$stmt->execute(array(':f1' => $pizzaid, ':f2' => $pitseriaID ));
$affected_rows = $stmt->rowCount();
echo $affected_rows . " riviä lisättiin<hr>\n";
echo "Tallennus Onnistui!";

echo "<a href= http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/pitsalista.php?pizzeriaID=$pitseriaID >Palaa<a/>";
?>