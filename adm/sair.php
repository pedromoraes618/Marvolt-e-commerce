<?php 
session_start();
unset($_SESSION["user_portal"]);
header("Location: ../../marvolt/login.php");
?>