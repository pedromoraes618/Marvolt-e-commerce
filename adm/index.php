<?php 

require_once("conexao/conexao.php"); 
include("conexao/sessao.php");
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/inicial.css" rel="stylesheet">

</head>

<body>
    <?php include_once("_incluir/topo.php"); ?>
    <?php include_once("_incluir/body.php"); ?>
    <?php include_once("_incluir/funcoes.php"); ?>

    <main>
 
    </main>


</body>
<script src="jquery.js"></script>
<script>
$('#lembrete').click(function() {
    document.getElementById("lembrete").style.display = "none";
});
</script>

</html>



<?php
    // Fechar conexao
    mysqli_close($conecta);
?>