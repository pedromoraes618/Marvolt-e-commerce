<?php
session_start(); 
//exclui a variavel de sesao mencionada
unset($_SESSION["usuario"]);

//destroi todas as variaveis de sessão da app.
session_destroy();

?>