
<?php

include ("navbar.php");
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
 
$nimi   = isset($_REQUEST['nimi'])   ? $_REQUEST['nimi']   : '';
$osoite = isset($_REQUEST['osoite']) ? $_REQUEST['osoite'] : '';
$aukiolo  = isset($_REQUEST['aukiolo'])  ? $_REQUEST['aukiolo']  : '';
$kotiinkuljetus   = isset($_REQUEST['kotiinkuljetus'])   ? $_REQUEST['kotiinkuljetus']   : '';

 
$sql = <<<SQLEND
INSERT INTO Pizzeria (nimi,osoite,aukiolo,kotiinkuljetus)
VALUES(:f1,:f2,:f3,:f4)
SQLEND;
 
$stmt = $db->prepare("$sql");
$stmt->execute(array(':f1' => $nimi, ':f2' => $osoite, ':f3' => $aukiolo,
                     ':f4' => $kotiinkuljetus ));
$affected_rows = $stmt->rowCount();
echo $affected_rows . " riviä lisättiin<hr>\n";
 
?>