
<h1 align="center">Pizza-app</h1>
<form method='get' action='home_user.php'align="center">

<h3>Hae pitserian nimen tai sen osan perusteella:</h3><br>


 <a href='logout.php'>Kirjaudu ulos</a>
<input type='text' name='hakuehto' value=''>
<input type='submit' value='Hae!'>

</form>

<?php
session_start();
$username=$_SESSION['user'];
include 'layout_head.php';
echo "Kirjautunut: ",$username;
echo"<br>";
$hakuehto = isset($_GET['hakuehto']) ? $_GET['hakuehto'] : '';
     
$stmt = haepizzeriat($db, $hakuehto);
sqlResult2Html($stmt);

// 
function haepizzeriat($db, $hakuehto) {
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
$col_count  = $stmt->columnCount();
 
echo "Hakutulokset:" . $row_count. " riviä:<hr>\n";
echo "<table class='table table-hover table-responsive table-bordered'>";  
$output = <<<OUTPUTEND
<h4>Mistä Haluat Tilata?</h4>
<tr bgcolor='#ffeedd'>
<td><b>Pizzeria</b></td><td>Osoite</td><td>Aukiolo</td>
<td>Kotiinkuljetus</td>
</tr>
OUTPUTEND;
echo $output;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	if($row['kotiinkuljetus']==1){
		$kotiinkuljetus="Löytyy";
	}else{$kotiinkuljetus="Ei ole";}
    $output = <<<OUTPUTEND
    <tr>
    <td><a href='pitsalista_user.php?pizzeriaID={$row['pizzeriaID']}'>{$row['nimi']}</a></td><td>{$row['osoite']}</td><td>{$row['aukiolo']}</td><td>$kotiinkuljetus</td>
	
	
	
    
   </tr>
OUTPUTEND;
    echo $output;
}

    
 
    
echo "</table>\n";
}
include 'layout_foot.php';

?>


