<!DOCTYPE html>

<?php 
include("conexao/sessao.php");
include "crud.php";
include "funcao/script.php";
include "lib/alertify/alert.php";
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
</head>

<body id="body" onload="loading()">
    <div class="container">
        <div class="row" id="top-1">
            <?php 
        //incluir o topo
         include "topo.php";
         
         ?>
            </form>
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


        <?php 
        if(!$_GET){
        ?>
        <div class="row" id="email">
            <div class="container">
                <div class="titulo">
                    <p>Cadastre-se para receber nossas ofertas!</p>
                </div>
                <div class="formulario">
                    <form method="POST" class="form" id="enviar">
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
        <!-- loading -->
        <div class="loader"></div>

        <?php 
        }else{
            ?>
        <div class="row" id="voltar-incio">
            <a href="index.php">
                <p>Inicio</p>
            </a>
        </div>


        <?php 
        }
        
       include "footer.php";
       ?>
    </div>
    <div class="box-cookies hide">
        <p class="msg-cookies">Este site usa cookies, que são necessários para o funcionamento técnico do site e que
            estão sempre configurados. Outros cookies, que aumentam o conforto na utilização deste website, são
            utilizados para publicidade direta ou para simplificar a interação com outros websites e redes sociais,
            apenas são definidos com o seu consentimento.
            Mais informações podem ser encontradas em nossa política de privacidade.
            <a href="#">
                Política de privacidade
            </a>
        </p>

        <div class="btn-cookies">Aceitar!</div>
    </div>

    </div>



    <script src="_js/jquery.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script src="_js/script.js"></script>
    <script src="_js/vanilla-tilt.js"></script>
    <script src="lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


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
            alertify.success("Cadastro realizado com sucesso!");
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


if (!localStorage.nossoCooke) {
    document.querySelector(".box-cookies").classList.remove('hide')
}
const acceptCookies = () => {
    document.querySelector('.box-cookies').classList.add('hide');
    localStorage.setItem("nossoCooke", "accept");
}
const btnCookies = document.querySelector('.btn-cookies');
btnCookies.addEventListener('click', acceptCookies);

$(function() {

    // var myButton = document.getElementById('#abrir_filtro');
    // document.documentElement.onclick = function(event) {
    //     if (event.target !== myButton) {
    
    //         $('.menu_filtro nav').css("left", "-50vw");
    //     }
    // }

    $('#abrir_menu_mobile').click(function() {
        $(".menu-mobile .nav-mobile").css("display", "block")

        $(".menu-mobile .nav-mobile").css("left", "0vw")
    })
    $('#fechar_menu_mobile').click(function() {
        $(".menu-mobile .nav-mobile").css("left", "-50vw")
    })

})
$(function() {
    $('#abrir_filtro').click(function() {
        $('.menu_filtro nav').css("left", "0vw");
    })

    $('#fechar_filtro').click(function() {
        $('.menu_filtro nav').css("left", "-50vw");
    })



})
</script>



<?php
    // Fechar conexao
    mysqli_close($conecta);
?>