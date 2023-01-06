<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
include "conexao/conexao.php";
include "lib/alertify/alert.php";

//adicionar a variavel de sessão
session_start();
echo ',';


if(isset($_POST["email_login"])){
    $email =  $_POST["email_login"];
    $senha =  $_POST["senha"];
   
    $login = "SELECT * FROM tb_cliente WHERE  cl_email = '$email' or cl_cnpj = '$email' or cl_cpf = '$email'  ";
    $acesso = mysqli_query($conecta, $login);

    if( !$acesso ){
    die("Falha na consulta ao banco de dados");
    }else{
    $linha = mysqli_fetch_assoc($acesso);
    $b_email = $linha['cl_email'];
	$b_cpf = $linha['cl_cpf'];
	$b_cnpj = $linha['cl_cnpj'];
	
    $b_senha = $linha['cl_senha'];
    $b_senha = base64_decode($b_senha);

    if (($b_email == $email or $b_cpf == $email or $b_cnpj == $email) and $b_senha == $senha){
    $_SESSION["user_cliente_portal"] = time(10000000);
    $_SESSION["user_cliente_portal"] = $linha["cl_id"];
    header("Location: index.php");
    }else{
        ?>
<script>
Swal.fire(
    'Dados incorreto',
    'Verifique se os campos foram prenchidos corretamentes',
    'question'
)
</script>
<?php

    
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

<body>

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
                                <input type="text" class="form-control" value="<?php if($_POST){
                                echo $email;
                                } ?>" name="email_login" onblur="btn_ativo()" id="email"
                                    placeholder="Email / cpf / cnpj">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                                </div>
                                <input type="password" class="form-control" onblur="btn_ativo()" value="<?php if($_POST){
                                echo $senha;
                                } ?>" name="senha" id="senha" placeholder="*******">
                                <i id="mostrar_senha" class="fa-solid fa-eye"></i>
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <button type="submit" id="btn_login" disabled class="btn btn-primary">Login</button>

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
    <script src="_js/jquery.mask.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
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
let senha = document.getElementById("senha")
let email = document.getElementById("email")
let btn_login = document.getElementById("btn_login")


$(document).keydown(function(event){
    if (email.value != "" & senha.value != "") {
        btn_login.removeAttribute("disabled", "disabled");
    } else {
        btn_login.setAttribute("disabled", "disabled");
    }
})

$("#mostrar_senha").click(function() {

    if (senha.type == "password") {
        senha.type = "text";

    } else {
        senha.type = "password";
    }
})
</script>

<?php
    // Fechar conexao
 //   mysqli_close($conecta);
?>
