<?php
// abook-lisaa.php

require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
 
$user   = isset($_REQUEST['user'])   ? $_REQUEST['user']   : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';


 
$sql = <<<SQLEND
INSERT INTO Users (Kayttaja,psw)
VALUES(:f1,:f2)
SQLEND;
try{
 $cryptpassword= crypt($password);
$stmt = $db->prepare("$sql");

$stmt->execute(array(':f1' => $user, ':f2' => $cryptpassword ));
$affected_rows = $stmt->rowCount();
echo $affected_rows . " riviä lisättiin<hr>\n";
 echo "<a href= http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/index.php>Palaa<a/>";
echo "Lisäys onnistui";
}
catch (Exception $e){echo "Käyttäjänimi Varattu";
echo"<br>";
echo "<a href=http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/index.php>Palaa<a/>";}

?>