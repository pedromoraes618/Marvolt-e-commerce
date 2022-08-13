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
</head>

<body>
    <div class="container">
        <div class="row" id="top-1">
            <div class="secition-top">
                <div class="top-1-1" id="movelmenu">
                    <section class="top-1-1-1">
                        <div class="col logo-marvolt-top-1">
                            <img src="img/LogoPreto.png">
                        </div>
                        <div class="col menu-cliente">
                            <p>(98) 988814696 | Cliente | Cadastrar <i class="fa-solid fa-user"></i></p>
                        </div>
                    </section>
                </div>
                <form method="get">
                    <div class="top-1-2">
                        <section class="top-1-1-2">
                            <div class="col logo-marvolt">
                                <a href="/marvoltect"> <img src="img/LogoPreto.png">
                                </a>
                            </div>
                            <div class="col input-pesquisa">
                                <input type="text" name="buscar" placeholder="O que você procura?"> <button
                                    type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            <div class="carrinho-compras">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                        </section>
                    </div>
                    <?php 
                 include "menu.php";
               ?>
            </div>
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
       include "footer.php";
       ?>

    </div>


    <script src="_js/jquery.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script src="_js/script.js"></script>
    <script src="_js/vanilla-tilt.js"></script>
    <script src="lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>

    <script src="_js/script.js"></script>

</body>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>