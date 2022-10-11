<?php 
include "../conexao/conexao.php";
include "../lib/alertify/alert.php";
include "funcao/script.php";
//adicionar a variavel de sessão
echo "<p id='hidden'>,</p>";



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

    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
</head>

<body>

    <div class="main-login">

        <div class="login-left">
            <h1>Cadastre-se para ter acesso<br>Ao adminstrador do site </h1>
            <img src="img/login/tela_cadastro.svg" alt="imagem" class="left-login-img">

        </div>

        <div class="login-right">
            <div class="card-login">
                <div class="formulario">
                    <div class="formulario-top">

                        <h3>Administrador<br>Cadastre-se</h3>
                    </div>
                    <form id="formulario_cadastro" method="POST">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" name="email" id="email" value="<?php 
                            
                                ?>" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" name="usuario" id="usuario" value="<?php 
                    
                                ?>" placeholder="Usuário">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control" name="senha" id="senha" value="<?php 
                            
                                ?>" placeholder="Senha">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-litecoin-sign"></i></div>
                                </div>
                                <input type="text" class="form-control" name="token" id="token" placeholder="Token">
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
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                            <div class="sub-form">
                                <hr>
                                <div class="cadastrar">
                                    <p>Entre na marvolt! <a href="login.php">Login</a></p>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>





    <script src="../_js/jquery.js"></script>
    <script src="../_js/bootstrap.min.js"></script>
 
</body>


</html>



<script>
function mostrarOcultarSenha() {
    var senha = document.getElementById("senha");
    if (senha.type == "password") {
        senha.type = "text";

    } else {
        senha.type = "password";
    }

}




$("#formulario_cadastro").submit(function(e) {
    e.preventDefault(); //evito o submit do form ao apetar o enter..
    email = document.getElementById("email");
    usuario = document.getElementById("usuario");
    senha = document.getElementById("senha");
    token = document.getElementById("token");

    var formulario = $(this);
    var retorno = enviarCadastro(formulario);
})

function enviarCadastro(dados) {
    $.ajax({
        type: "POST",
        data: dados.serialize(),
        url: "crud.php",
        async: false
    }).then(sucesso, falha);

    function sucesso(data) {

        $mensagem = $.parseJSON(data)["mensagem"];
        $sucesso = $.parseJSON(data)["sucesso"];
        alertify.alert($mensagem)

        if ($sucesso) {
            usuario.value = "";
            senha.value = "";
            email.value = "";
            token.value = "";
        }
    }

    function falha() {
        console.log("erro");
    }

}
</script>

<?php
    mysqli_close($conecta);
?>