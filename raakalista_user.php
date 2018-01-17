
<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style>



<hr>
<?php
// mysql-pdo-search.php
 include ("navbar_user.php");
 include 'layout_head.php';
$id = isset($_GET['pizzaID']) ? $_GET['pizzaID'] : ' ei mitaan';


 $st = $db->prepare("SELECT nimi FROM Pizza WHERE pizzaID = $id");

$st->execute();
$row = ($st->fetch(PDO::FETCH_ASSOC));
?><h1 align ="center"><?php echo $row["nimi"];echo "<h1>";
$stmt = haeraaka($db, $id);

sqlResult2Form($stmt);

 $_SESSION['id']= $id;
// 
function haeraaka($db, $id) {
  $sql = <<<SQLEND
SELECT piz.nimi, raaka.*
FROM Raaka_aineet raaka
INNER JOIN Pizza_Raaka_aineet pira ON pira.raaka_aineID = raaka.raaka_aineID
INNER JOIN Pizza piz ON piz.pizzaID = pira.pizzaID
WHERE pira.pizzaID=$id

SQLEND;


 
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt->execute();
   return $stmt;    
}

function haekaikkiraaka($db, $id)

 {
 $sql = <<<SQLEND
SELECT raaka_aineID,nimi
FROM Raaka_aineet 

SQLEND;

   $stmt2 = $db->prepare($sql);
   $stmt2->bindValue(':id', "$id", PDO::PARAM_STR);
   $stmt2->execute();
   return $stmt2;    
}
 
// SQL-kyselyn tulosjoukko HTML-taulukkoon.
function sqlResult2Form($stmt) {
 

echo "<table class='table table-hover table-responsive table-bordered'>";
 
        // our table heading
       
            echo "<th class='textAlignLeft'>Raaka-aineet</th>";
                
       
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
                echo "<td>";
                    echo "<div class='product-name'>{$row['nimi']}</div>";
                echo "</td>";
               
            
            echo "</tr>";
        }
 
    echo "</table>";
}
 
 
 

 
include 'layout_foot.php';
 






 
?>