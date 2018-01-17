<html style='background-image: url("./Kuvat/pizzatausta.jpg")'>
<head>
    <title> PIZZA-APP</title>
    <link rel = "stylesheet" type="text/css" href="login_style.css">
</head>
 <body>
 
   <form method="POST" align="center">
    <label>Username</label><br/>
    <input name="username" type="text"/><br/>
    <label>Password</label><br/>
    <input name="password" type="password"/><br/>
    <button name="log_in">Log In</button>
	
     <a href='registerlomake.php'>Register</a>
  
   </form>
   </body>
</html>

<?php
if(isset($_POST['log_in'])) {
require_once ("/home/H4102/public_html/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/db-init.php");
session_start();
$username=$_POST['username'];
$password=$_POST['password'];

$st = $db->prepare("SELECT psw FROM Users WHERE Kayttaja='$username'");//haetaan käyttäjän cryptattu salasana


$st->bindValue(":username", "$username");
$st->execute();
$numrows= $st->rowCount();
if($numrows!=0){ //katsotaan onko syötettyä käyttäjää
$db = $st->fetch(PDO::FETCH_OBJ);



if ($db->psw == crypt($password,$db->psw)){ //Tarkistetaan onko salasana oikein
	$_SESSION['logged']="Kirjautunut";
 if($username=="admin"){	 // jos käyttäjä admin ja salasana oikein siirrytään adminpuolelle
 $_SESSION['logged']="admin";
 header('location:http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/Etusivu.php');
 
 }
 else{
	 $_SESSION['user']=$username; // Muuten mennään käyttäjäpuolelle
header('location:http://student.labranet.jamk.fi/~H4102/PHP/Jarvensivu-Matti-harkkatyo/Pizza_app/home_user.php');

 }
  } else echo "<div align='center'>salasana väärin</div>";


} else echo"<div align='center'>Ei ole kyseistä käyttäjää</div>";


}
?>

