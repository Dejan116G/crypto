<?php
include_once "session.php";
include_once "database.php";

$title = $_POST['title'];
$description = $_POST['description'];
$current_price = floatval($_POST['current_Price']); //kzezerzezrz0,64646agaggag => 0
$logo = $_POST['logo'];

//preverim, ali so podatki polni
if(!empty($title) && !empty($logo)){

$query  = "INSERT INTO cryptocurrencies(title,description,current_price,logo) VALUES(?,?,?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$title,$description,$current_price,$logo]);

header("Location: cryptocurrencies.php");
die();
}
else{
header("Location: cryptocurrencies_add.php");
die();
}

   
?>