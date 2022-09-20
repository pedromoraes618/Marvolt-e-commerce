<?php 
include "conexao/conexao.php";
include "lib/alertify/alert.php";
include "funcao/script.php";
//adicionar a variavel de sessão
session_start();
echo "<p id='hidden'>,</p>";
//funcao para verificar se o email já foi cadastrado anteriomente
function consultarEmail($email){
    include "conexao/conexao.php";
    $select = "SELECT count(*) as quantidade from tb_cliente where cl_email = '$email' " ; 
    $operacao_verificar_email = mysqli_query($conecta,$select);
    if($operacao_verificar_email){
     $linha = mysqli_fetch_assoc($operacao_verificar_email);
     $resultado = $linha['quantidade'];
    }else{
        die("erro banco de dados tb_clientes cl_email");
    }
    return $resultado;
}
//cadastrar usuario
if(isset($_POST["usuario"])){
    $usuario =  $_POST["usuario"];
    $email =  $_POST["email"];
    $senha =  $_POST["senha"];
    $tipo = $_POST["tipo_cliente"];
    $senha = base64_encode($senha);
    if($email == ""){
        ?>
<script>
alertify.alert("O campo Email não foi preenchido");
</script>
<?php
    }elseif($usuario ==""){
        ?>
<script>
alertify.alert("O campo Usuário não foi preenchido");
</script>
<?php
    }elseif($senha ==""){
        ?>
<script>
alertify.alert("O campo Senha não foi preenchido");
</script>
<?php
    }elseif(consultarEmail($email)>0){
        ?>
<script>
alertify.alert("Esse Email já foi cadastrado")
</script>
<?php
    }else{
    $inserir = "INSERT INTO tb_cliente ";
    $inserir .= "(cl_data_cadastro,cl_usuario,cl_senha,cl_tipo_cliente,cl_email)";
    $inserir .= " VALUES ";
    $inserir .= "('$hoje','$usuario','$senha','$tipo','$email' )";
    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro banco de dados tb_cliente");
    }else{
        ?>
<script>
alertify.success("Cadastro realizado com sucesso");
</script>
<?php
   $email ="";
   $senha = "";
   $usuario ="";
   $tipo = "0";
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
            <h1>Você merece o que há de melhor<br>Cadastre-se para conhecer os melhores produtos </h1>
            <img src="img/People flying-rafiki.svg" alt="imagem" class="left-login-img">

        </div>

        <div class="login-right">
            <div class="card-login">
                <div class="formulario">
                    <div class="formulario-top">

                        <h3>Cadastre-se</h3>
                    </div>
                    <form id="formulario_cadastro" method="POST">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" name="email" id="email" value="<?php 
                                if($_POST){
                                    echo $email;
                                }
                                ?>" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" name="usuario" id="usuario" value="<?php 
                                if($_POST){
                                    echo $usuario;
                                }
                                ?>" placeholder="Usuário">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control" name="senha" id="senha" value="<?php 
                                if($_POST){
                                    echo $senha;
                                }
                                ?>" placeholder="Senha">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_cliente" id="tipo_cliente" <?php 
                                if($_POST){
                                if($tipo == "0"){
                                    ?> checked <?php
                                }
                            }else{
                                ?>
                                checked
                                <?php
                            }
                                ?> value="0">
                                <label class="form-check-label" for="exampleRadios1">
                                    Pessoa fisica
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_cliente" id="tipo_cliente" <?php 
                                  if($_POST){
                                if($tipo == "1"){
                                    ?> checked <?php
                                }
                            }?> value="1">
                                <label class="form-check-label" for="exampleRadios2">
                                    Pessoa jurídica
                                </label>
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
                                <div class="senha-esqueci">
                                    <a href="">
                                        <p>Apos ser feito o login é necessario <br> completar o cadastro</p>
                                    </a>
                                </div>
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


<script>
function mostrarOcultarSenha() {
    var senha = document.getElementById("senha");
    if (senha.type == "password") {
        senha.type = "text";

    } else {
        senha.type = "password";
    }

}

// //receber
// $(document).ready(function() {
//     $("#formulario_cadastro").submit(function(e) {
//         e.preventDefault();
//         var campoUsuario = document.getElementById("usuario");
//         var campoSenha = document.getElementById("senha");
//         var campoEmail = document.getElementById("email");
//         var campotipo = document.getElementById("tipo_cliente").value;
//         var formulario = $(this);

//         if (campoUsuario.value == "") {
//             alertify.alert("Favor preencher o campo Usuario")
//         } else if (campoSenha.value == "") {
//             alertify.alert("Favor preencher o campo Senha")
//         } else if (campoEmail.value == "") {
//             alertify.alert("Favor preencher o campo Email")
//         } else {
//             var retorno = cadastar(formulario);
//             alertify.success("Cadastro realizado com sucesso")
//             campoUsuario.value = "";
//             campoSenha.value = "";
//             campoEmail.value = "";
//         }
//     })
// })



// function cadastar(dados) {
//     $.ajax({
//         type: "POST",
//         data: dados.serialize(),
//         async: false,
//         url: "crud.php"
//     }).done(function(data) {
//         //   $retorno = $.parseJSON(data)["mensagem"];
//         //   console.log($retorno);
//         // if ($retorno) {
//         //     console.log("Te")
//         // } else {
//         //     console.log("Erro banco de dados")
//         // }

//     })
// }



<?php
    mysqli_close($conecta);
?>



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