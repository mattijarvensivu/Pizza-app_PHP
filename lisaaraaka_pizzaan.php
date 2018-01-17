<?php
include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
session_start();

$valitturaaka = $_POST['raaka'];
$pizzaID = $_SESSION['id'];



$st = $db->prepare("SELECT raaka_aineID FROM Raaka_aineet WHERE nimi = :nimi");
$st->bindValue(":nimi", "$valitturaaka", PDO::PARAM_STR);
$st->execute();
$row = ($st->fetch(PDO::FETCH_ASSOC));
$raakaid=$row["raaka_aineID"];


$sql = <<<SQLEND
INSERT INTO Pizza_Raaka_aineet (raaka_aineID,pizzaID)
VALUES(:f1,:f2)
SQLEND;
 
$stmt = $db->prepare("$sql");
$stmt->execute(array(':f1' => $raakaid, ':f2' => $pizzaID ));
$affected_rows = $stmt->rowCount();
echo $affected_rows . " riviä lisättiin<hr>\n";
echo "Tallennus Onnistui!";

echo "<a href= http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/raakalista.php?pizzaID=$pizzaID >Palaa<a/>";

?>