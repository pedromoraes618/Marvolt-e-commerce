<?php

$lifetime=50000;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);
if(!isset($_SESSION["user_portal"])){
   
}

?>