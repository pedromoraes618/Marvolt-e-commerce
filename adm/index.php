<?php 
//sessão
include("conexao/sessao.php");
//conexão com o banco de dados
require_once("../conexao/conexao.php"); 
require_once("crud.php"); 

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="_css/estilo.css" rel="stylesheet">
    <meta name="author" content="Desenvolvedor Pedro moraes -+5598988814696">
    <meta property="og:title" content="Marvolt localizada em são do maranhão" />
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>Marvolt</title>

    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
</head>

<body>
    <section class="tela_incial">
        <?php include "topo.php" ?>
        <div class="tela_principal">
            <?php include "menu.php" ?>
            <?php 
            if($_GET){
                include "busca/pesquisa.php";
            }
            ?>
        </div>
    </section>



</body>


</html>


<?php
    // Fechar conexao
    mysqli_close($conecta);
?>

<script src="../_js/jquery.js"></script>
<script src="../_js/bootstrap.min.js"></script>

<script>
$(function() {
    $('#abrir-menu').click(function() {
        $(".menu").css("left", "0vw")
    })
    $('#fechar_menu').click(function() {
        $(".menu").css("left", "-60vw")
    })

})
</script>