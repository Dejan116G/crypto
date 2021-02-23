<?php
session_start();
//do katerih strani ima uporabnik dostop
$allow = ['/crypto/login.php','/crypto/register.php','/crypto/index.php','/crypto/login_check.php'];


//preverim ali je uporabnik prijavljen, če ni ga peljem na prijavo
if(!isset($_SESSION['user_id']) && (!in_array($_SERVER['REQUEST_URI'],$allow)))
{

    header("Location: login.php");
    die();
}

?>