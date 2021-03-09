<?php
include_once "session.php";
include_once "database.php";

$id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

// pogledam za katero kriptovaluto gre
$query = "SELECT * FROM comments WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$crypto = $stmt->fetch();
$crypto_id=$crypto['cryptocurrency_id'];

//izbriše le, če je trenutno prijavljen lastnik avtor komentarja.
$query = "DELETE FROM comments WHERE id = ? AND user_id = ? ";
$stmt = $pdo->prepare($query);
$stmt->execute([$id,$user_id]);

odziv("Komentar izbrisan");

header("Location: cryptocurrencies.php?id=$crypto_id#komentarji");
die();
?>