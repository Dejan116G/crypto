<?php
include_once "session.php";
include_once "database.php";



$id = $_SESSION['id'];

$target_dir = "avatars/";

$random = date('YmdHisu'); 

$target_file = $target_dir . $random . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//preveri ali datoteka ima dejansko velikost
$check = getimagesize($_FILES["avatar"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 2;
  }

// Check file size
if ($_FILES["avatar"]["size"] > 5000000) {
    $uploadOk = 3;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 4;
}


//preverim, ali so podatki polni
if ($uploadOk = 1){
    
if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
    $query  = "UPDATE users SET avatar = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title,$id]);

    header("Location: profile.php");
    die();

} else {
    header("Location: profile.php");
    die();
    }




}
else{
header("Location: profile.php");
die();
}

?>