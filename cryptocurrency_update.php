<?php
include_once "session.php";
adminOnly();
include_once "database.php";

$id = $_POST['id'];

$title = $_POST['title'];
$description = $_POST['description'];
$current_price = floatval($_POST['current_price']); //kzezerzezrz0,64646agaggag => 0


$target_dir = "uploads/";

$random = date('YmdHisu'); 

$target_file = $target_dir . $random . basename($_FILES["logo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//preveri ali datoteka ima dejansko velikost
$check = getimagesize($_FILES["logo"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 2;
  }

// Check file size
if ($_FILES["logo"]["size"] > 5000000) {
    $uploadOk = 3;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 4;
}


//preverim, ali so podatki polni
if(!empty($title)){

if($uploadOk == 1){

//uporabnik je ob urejanju naložil nov logo
if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
    $query = "UPDATE cryptocurrencies SET title=?, description=?, current_price=?, logo=? WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title,$description,$current_price,$target_file,$id]);

    header("Location: cryptocurrencies.php?id=".$id);
    die();

} else {
    header("Location: cryptocurrencies_edit.php?id=".$id);
    die();
    }
}
else{
    //uporabnik ob urejanju  ni naložil logotip

$query = "UPDATE cryptocurrencies SET title=?, description=?, current_price=?, logo=? WHERE id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$title,$description,$current_price,$target_file,$id]);

header("Location: cryptocurrencies.php?id=".$id);
die();

}
}
else{
header("Location: cryptocurrencies_add.php");
die();
}


   
?>