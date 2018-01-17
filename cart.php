<?php


include 'layout_head.php';
include 'navbar_user.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
 
if($action=='removed'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> was removed from your cart!";
    echo "</div>";
}
 
else if($action=='quantity_updated'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> quantity was updated!";
    echo "</div>";
}

if(count($_SESSION['cart_items'])>0){

    // Haetaan tuotteiden idet
    $ids = "";
    foreach($_SESSION['cart_items'] as $id=>$value){
        $ids = $ids . $id . ",";//pilkku väliin
    }
 
    // vika pilkku pois
    $ids = rtrim($ids, ',');
 
    //taulokko alkaa
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
        // taulukon otsikot
        echo "<tr>";
            echo "<th class='textAlignLeft'>Pizza</th>";
            echo "<th>Hinta </th>";
       
	   echo "</tr>";
	  
$sql= "SELECT pizzaID, nimi, hinta FROM Pizza WHERE pizzaID IN ({$ids})";
		
        
		
		
        $stmt = $db->prepare($sql);
		$stmt->bindValue(':ids', "$ids", PDO::PARAM_STR);
        $stmt->execute();
        $total_price=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 		
 
 
            echo "<tr>";
                echo "<td>{$row['nimi']}</td>";
                echo "<td>{$row['hinta']}</td>";
                echo "<td>";
                    echo "<a href='remove_from_cart.php?id={$row['pizzaID']}&name={$row['nimi']}' class='btn btn-danger'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Poista kärrystä";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
            $total_price+=$row['hinta'];
        
 }
        echo "<tr>";
                echo "<td><b>Total</b></td>";
                echo "<td>{$total_price}</td>";
                echo "<td>";
                    echo "<a href='#' class='btn btn-success'>";
                        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Tiskille";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
    echo "</table>";
	
}
 
else{
    echo "<div class='alert alert-danger'>";
        echo "<strong>Ei tuotteita</strong> ostoskorissa!";
    echo "</div>";
}

include 'layout_foot.php';
?>