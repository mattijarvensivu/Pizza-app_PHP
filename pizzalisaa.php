<?php

include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
 
$nimi   = isset($_REQUEST['nimi'])   ? $_REQUEST['nimi']   : '';
$hinta = isset($_REQUEST['hinta']) ? $_REQUEST['hinta'] : '';


 
$sql = <<<SQLEND
INSERT INTO Pizza (nimi,hinta)
VALUES(:f1,:f2)
SQLEND;
 
$stmt = $db->prepare("$sql");
$stmt->execute(array(':f1' => $nimi, ':f2' => $hinta ));
$affected_rows = $stmt->rowCount();
echo $affected_rows . " riviä lisättiin<hr>\n";
 echo "<a href= http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/naytapizzat.php>Palaa<a/>";
echo "Lisäys onnistui";
?>