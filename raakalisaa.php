<?php

include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
 
$nimi   = isset($_REQUEST['nimi'])   ? $_REQUEST['nimi']   : '';



 
$sql = <<<SQLEND
INSERT INTO Raaka_aineet (nimi)
VALUES(:f1)
SQLEND;
 
$stmt = $db->prepare("$sql");
$stmt->execute(array(':f1' => $nimi ));
$affected_rows = $stmt->rowCount();
echo $affected_rows . " riviä lisättiin<hr>\n";
 echo "<a href= http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/naytaraaka.php>Palaa<a/>";
echo "Lisäys onnistui";
?>