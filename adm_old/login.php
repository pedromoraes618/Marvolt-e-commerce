<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

<?php require_once("conexao/conexao.php"); 

//adicionar a variavel de sessão
session_start();
echo ',';
if(isset($_POST["usuario"])){
    $usuario =  $_POST["usuario"];
    $senha =  $_POST["senha"];

    $login = "SELECT * FROM tb_user WHERE cl_usuario = '{$usuario}' and cl_senha ='{$senha}'";
    $acesso = mysqli_query($conecta, $login);

    if( !$acesso ){
        die("Falha na consulta ao banco de dados");
    }

    $informacao = mysqli_fetch_assoc($acesso);
    if (empty($informacao)){
        ?>
<script>
alertify.error("Login sem sucesso");
</script>
<?php
            
    }else{
        $_SESSION["user_portal"] = time(10000000);
        $_SESSION["user_portal"] = $informacao["cl_id"];
         header("Location: index.php");

}

}

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Effmax</title>

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/login.css" rel="stylesheet">
</head>

<body>

    <?php include_once("_incluir/funcoes.php"); ?>

    <main>
        <div id="janela_principal">
            <form action="login.php" method="post">
                <h2>Login</h2>

                <input type="text" name="usuario" id="usuario" placeholder="Usuário" required
                    placeholder="Digite o seu usuario">
                <input type="password" name="senha" placeholder="Senha" id="senha" required
                    placeholder="Digite a sua senha">
                <input type="checkbox" name="mostrarSenha" onclick="mostrarOcultarSenha()" id="mostrarSenha">
                <label id="mostrarSenha" for="mostrarSenha">Mostrar senha</label>





                <input type="submit" name="Login" placeholder="Login" value="Login">
                <div id="footer">
                    <p><a href="resetar_senha.php">Resertar senha<a></a>
                </div>
        </div>
    </main>


</body>

</html>

<?php
    // Fechar conexao
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
</script>