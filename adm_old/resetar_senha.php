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

//inserção no banco de dados
echo ",";

if(isset($_POST["resetar"])){
    $login = utf8_decode($_POST["login"]);
    $senhaAtual = utf8_decode($_POST["senhaAtual"]);
    $senhaNova = utf8_decode($_POST["senhaNova"]);


    $select = "SELECT * FROM usuarios where usuario = '{$login}' ";
    $operacao_select = mysqli_query($conecta, $select);
    if(!$operacao_select){
        die("Falha na consulta ao banco de dados Usuraio");
        }else{
            $row = mysqli_fetch_assoc($operacao_select);
            $loginB = $row['usuario'];
            $senhaB = $row['senha'];
        }
    
    if(($loginB == $login) and ($senhaB == $senhaAtual)){
        $update = "UPDATE usuarios set senha = '{$senhaNova}' where usuario = '{$login}' ";
        $operacao_update = mysqli_query($conecta, $update);
            if(!$operacao_update){
                die("Erro no banco de dados || update na senha || Tabela usuarios");
            }else{
                ?>
<script>
alertify.success("Senha resetada com sucesso!");
</script>
<?php
    }  
            }else{
              
                    ?>
<script>
alertify.alert("Daddos incorretos");
</script>
<?php
            }
    }

                                    



?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/login.css" rel="stylesheet">
</head>

<body>

    <?php include_once("_incluir/funcoes.php"); ?>

    <main>
        <div id="janela_principal">
            <form action="" method="post">
                <h2>Resetar Senha</h2>
                <input type="text" name="login" id="login" placeholder="Login" required
                    placeholder="Digite o seu Login">
                <input type="password" name="senhaAtual" placeholder="Senha atual">
                <input type="password" name="senhaNova" placeholder="Nova senha">


                <input type="submit" name="resetar" value="Resetar">
                <div id="footer">
                    <p><a href="login.php">Login<a></a>
                </div>

        </div>


    </main>


</body>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>