<?php 
session_start();
unset($_SESSION["user_cliente_portal"]);
header("Location: login.php");
?>