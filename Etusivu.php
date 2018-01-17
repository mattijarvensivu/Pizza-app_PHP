
<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>


<?php
session_start();
if(isset($_SESSION['logged'])){
if($_SESSION['logged']=="admin"){
	
	
echo"<style type='text/css'>";
echo"tr:nth-child(odd) {background: #f1f1f1}";
echo"tr:nth-child(even) {background: #ffffff}";
echo"tr:nth-child(1) {background: #ffeedd}";
echo"</style>";


echo"<form method='get' action='naytapizzat.php'>";
echo"Hae pitserian nimen tai sen osan perusteella:<br>";
echo"<input type='text' name='hakuehto' value=''>";
echo"<input type='submit' value='Hae!'>";
echo"</form>";
echo"<hr>";
	



 include ("navbar.php"); //lisätään navigointipalkki
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php"); //Yhteys tietokantaan
 
$hakuehto = isset($_GET['hakuehto']) ? $_GET['hakuehto'] : '';
     

 
// 
function haepizzeriat($db, $hakuehto) { // Haetaan kaikki pizzeriat jotka vastaavat hakuehtoa
   $sql = <<<SQLEND
   SELECT pizzeriaID, nimi, osoite, aukiolo, kotiinkuljetus  
   FROM Pizzeria WHERE nimi
   LIKE :hakuehto
SQLEND;
 
   $stmt = $db->prepare("$sql");
   $stmt->bindValue(':hakuehto', "%$hakuehto%", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}
 

function sqlResult2Html($stmt) {
 
$row_count = $stmt->rowCount();

 
echo "Hakutulokset:" . $row_count. " riviä:<hr>\n";
echo "<table border='0'>\n";  //luodaan taulukko datalle
$output = <<<OUTPUTEND
<tr bgcolor='#ffeedd'>
<td>nimi</td><td>osoite</td><td>aukiolo</td> 
<td>kotiinkuljetus</td>
</tr>
OUTPUTEND;
echo $output;
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { //Tulostetaan kaikki pizzeriat
	if($row['kotiinkuljetus']==1){             
		$kotiinkuljetus="Löytyy";
	}else
	{$kotiinkuljetus="Ei ole";}
    $output = <<<OUTPUTEND
    <tr>
    <td><a href='pitsalista.php?pizzeriaID={$row['pizzeriaID']}'>{$row['nimi']}</a></td><td>{$row['osoite']}</td><td>{$row['aukiolo']}</td><td>$kotiinkuljetus</td>
	<td><a href='poistapizzeria.php?pizzeriaID={$row['pizzeriaID']}'
	onclick="return confirm('Haluatko varmasti poistaa kohteen {$row['nimi']}?')">Poista</a></td>
	
    
   </tr>
OUTPUTEND;
    echo $output;
}

    
 
    
echo "</table>\n";
}
$stmt = haepizzeriat($db, $hakuehto);
sqlResult2Html($stmt);
}
}else {echo "Kirjaudu sisään ensin";
echo"<br>";
?><img src="snoop.gif"style="width:150px;height:200px">
<?php
echo "<a href='index.php'>Kirjaudu tästä</a>";
}
?>
