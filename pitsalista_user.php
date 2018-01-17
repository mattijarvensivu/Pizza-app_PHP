

<style type='text/css'>
tr:nth-child(odd) {background: #f1f1f1}
tr:nth-child(even) {background: #ffffff}
tr:nth-child(1) {background: #ffeedd}
</style> 

<hr>


<?php

include ("navbar_user.php");
include 'layout_head.php';


$action = isset($_GET['action']) ? $_GET['action'] : "";
$pizzeriaid = isset($_GET['pizzeriaID']) ? $_GET['pizzeriaID'] : ' ei mitaan';
$name = isset($_GET['name']) ? $_GET['name'] : "";


$_SESSION['id']=$pizzeriaid;



if($action=='added'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> was added to your cart!";
    echo "</div>";
}
 
if($action=='exists'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> already exists in your cart!";
    echo "</div>";
}
$st = $db->prepare("SELECT nimi FROM Pizzeria WHERE pizzeriaID = $pizzeriaid");
$st->execute();
$row = ($st->fetch(PDO::FETCH_ASSOC));
 ?><h1 align ="center"><?php echo $row['nimi']; echo"<h1>";

 $sql = <<<SQLEND
SELECT pizze.nimi, pizza.*
FROM Pizza pizza
INNER JOIN Pizzeria_Pizza pipi ON pipi.pizzaID = pizza.pizzaID
INNER JOIN Pizzeria pizze ON pizze.pizzeriaID = pipi.pizzeriaID
WHERE pipi.pizzeriaID=$pizzeriaid

SQLEND;

   $stmt = $db->prepare($sql);
   $stmt->execute();
   $stmt->bindValue(':pizzeriaid', "$pizzeriaid", PDO::PARAM_STR);
    $num = $stmt->rowCount(); 

if($num>0){
 
    //aloitetaan taulukko
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
        // Taulukon otsikot
        echo "<tr>";
            echo "<th class='textAlignLeft'>Pizzat</th>";
            echo "<th>Hinta €</th>";
            
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
 
            //luodaan taulukon rivit rivi kerrallaan
            echo "<tr>";
                echo "<td>";
                    echo "<div class='product-name'><a href='raakalista_user.php?pizzaID={$row['pizzaID']}'>{$row['nimi']}</div>";
                echo "</td>";
                echo "<td>{$row['hinta']}</td>";
                echo "<td>";
                    echo "<a href='add_to_cart.php?id={$row['pizzaID']}&name={$row['nimi']}' class='btn btn-primary'>";
                        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Lisää Ostoskoriin";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
        }
 
    echo "</table>";
}
 
 
 
 else{//Jos pitseriassa ei tuotteita
    echo "Ei Tuotteita.";
}
 
include 'layout_foot.php';
 

?>









