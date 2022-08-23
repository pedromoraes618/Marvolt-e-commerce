<!DOCTYPE html>

<?php 
include "crud.php";

?>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="_css/bootstrap.min.css" rel="stylesheet">
    <link href="_css/estilo.css" rel="stylesheet">
    <meta name="author" content="Desenvolvedor Pedro moraes -+5598988814696">
    <meta property="og:title" content="Marvolt localizada em são do maranhão" />
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>Marvoltetc</title>
    <link rel="stylesheet" href="lib/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="lib/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

</head>

<body>
    <div class="container">
        <div class="row" id="top-1">
            <?php 
        //incluir o topo
         include "topo.php";
         ?>
        </div>

        <div class="bloco-central">

            <?php 
            if(!$_GET){ 
             include "incial.php";
            }else{
            include "busca/pesquisa.php";
            }
    
            ?>

        </div>
        </form>
        <?php 
        if(!$_GET){
        ?>
        <div class="row" id="email">
            <div class="container">
                <div class="titulo">
                    <p>Cadastre-se para receber nossas ofertas!</p>
                </div>
                <div class="formulario">
                    <form method="POST" class="form" action="https://api.staticforms.xyz/submit" id="enviar">
                        <input type="hidden" name="accessKey" value="f4e33596-cae1-4728-8d33-85043c1d0e17">
                        <!-- Required -->
                        <input type="hidden" name="redirectTo" value="index.php"> <!-- Optional -->

                        <input type="text" name="name" id="name" placeholder="Nome">
                        <input type="text" name="email" id="email_formulario" placeholder="E-mail">

                        <button class="button_enivar" onclick="sendEmail()" type="submit">enviar</button>

                    </form>
                </div>
            </div>

        </div>

        <?php 
        }
       include "footer.php";
       ?>

    </div>


    <script src="_js/jquery.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script src="_js/script.js"></script>
    <script src="_js/vanilla-tilt.js"></script>
    <script src="lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="_js/script.js"></script>

</body>

</html>

<script>
//funcção para enviar o email
var nome = document.getElementById("name");
var email = document.getElementById("email_formulario");

$(document).ready(function() {
    $("#enviar").submit(function(e) {
        e.preventDefault(); //evito o submit do form ao apetar o enter..
        var formulario = $(this);
        if (nome.value == "") {
            alertify.alert("Favor preencher o campo nome")
        } else if (email.value == "") {
            alertify.alert("Favor preencher o campo email");
        } else {
            var retorno = enviar(formulario);
            alertify.success("Cadastro realizado!");
            nome.value = "";
            email.value = "";
        }

    });
});


function enviar(dados) {
    $.ajax({
        type: 'POST',
        data: dados.serialize(),
        async: false,
        url: "https://api.staticforms.xyz/submit"
    }).then(sucesso, falha)

    function sucesso(data) {

    }

    function falha(data) {
        console.log("erro")
    }
}
</script>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>