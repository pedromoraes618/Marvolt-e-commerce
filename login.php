<?php 
include "conexao/conexao.php";
include "lib/alertify/alert.php";
//adicionar a variavel de sessão
session_start();
echo ',';

if(isset($_POST["usuario"])){
    $usuario =  $_POST["usuario"];
    $senha =  $_POST["senha"];
   
        if($usuario =="" && $senha ==""){
        ?>
<script>
alertify.error("Favor informar usuario e senha");
</script>
<?php
    }elseif($senha==""){
        ?>
<script>
alertify.error("Campo Senha não foi preenchido");
</script>
<?php
    }elseif($usuario ==""){
        ?>
<script>
alertify.error("Campo não preenchido");
</script>
<?php
 }else{

    $login = "SELECT * FROM tb_cliente WHERE cl_usuario = '{$usuario}' ";
    $acesso = mysqli_query($conecta, $login);

    if( !$acesso ){
    die("Falha na consulta ao banco de dados");
    }else{
    $linha = mysqli_fetch_assoc($acesso);
    $b_usuario = $linha['cl_usuario'];
    $b_senha = $linha['cl_senha'];
    $b_senha = base64_decode($b_senha);
 

    if ($b_usuario == $usuario and $b_senha == $senha){
    $_SESSION["user_portal"] = time(10000000);
    $_SESSION["user_portal"] = $linha["cl_id"];
    header("Location: index.php");
    }else{
        ?>
<script>
alertify.error("Login sem sucesso");
</script>
<?php

    }
}
 }
   
}

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="_css/login.css" rel="stylesheet">
    <meta name="author" content="Desenvolvedor Pedro moraes -+5598988814696">
    <meta property="og:title" content="Marvolt localizada em são do maranhão" />
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>Marvolt</title>
    <link rel="stylesheet" href="lib/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="lib/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
</head>

<body style="">

    <div class="main-login">

        <div class="login-left">
            <h1>Encontre os produtos certo<br>Para a sua Empresa</h1>
            <img src="img/building-safety-animate.svg" alt="imagem" class="left-login-img">

        </div>

        <div class="login-right">
            <div class="card-login">
                <div class="formulario">
                    <div class="formulario-top">

                        <h3>Entre</h3>
                    </div>
                    <form id="formulario_login" method="POST">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" name="usuario" id="usuario"
                                    placeholder="Usuário">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="*******">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
                                    onclick="mostrarOcultarSenha()">
                                <label class="form-check-label" for="invalidCheck2">
                                    Mostrar senha
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <div class="sub-form">
                                <div class="senha-esqueci">
                                    <a href="">
                                        <p>Esqueci minha senha<p>
                                    </a>
                                </div>
                                <hr>
                                <div class="cadastrar">
                                    <p> Novo na Marvolt? <a href="cadastrar.php">Cadastre-se</a></p>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>





    <script src="_js/jquery.js"></script>
    <script src="_js/bootstrap.min.js"></script>
    <script src="_js/script.js"></script>
    <script src="_js/vanilla-tilt.js"></script>
    <script src="lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="_js/script.js"></script>
    <script src="_js/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>

</body>

</html>
<?php
    mysqli_close($conecta);
?>

<script>
function mostrarOcultarSenha() {
    var senha = document.getElementById("senha");
    if (senha.type == "password") {
        senha.type = "text";

    } else {
        senha.type = "password";
    }

}






// $.post('crud.php', function(retornar) {
//             $user = $.parseJSON(retornar)["user"];
//             $senha = $.parseJSON(retornar)["senha"];
//             $sessao = $.parseJSON(retornar)["sessao"];
//             alertify.alert($senha);

//             if (campoUsuario == $user && campoSenha == $senha) {
//                 location.href = "index.php";

//             } else if (campoUsuario != $user) {
//                 alertify.alert("Usuario incorreto");
//             } else if (campoSenha != $senha) {
//                 alertify.alert("Senha incorreto");
//             } else {
//                 alertify.alert("Login incorreto");
//             }

//         })
</script>

<?php
    // Fechar conexao
 //   mysqli_close($conecta);
?>