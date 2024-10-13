<?php  
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

if ($username == "biwa" && $password == "30agustus") { 
    $_SESSION["username"] = $username; 
    header("location:home.php");
    exit();
} else { 
    header("location:index.php?login_gagal"); 
    exit();
} 
?>