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
if(isset($_POST["usuario"])){
   
    $usuario = utf8_decode($_POST["usuario"]);
    $senha = utf8_decode($_POST["senha"]);
    $email = utf8_decode($_POST["email"]);
    $nivel = utf8_decode($_POST["nivel"]);


    $inserir = "INSERT INTO usuarios ";
    $inserir .= "(email,usuario,senha,nivel)";
    $inserir .= " Values ";
    $inserir .= "('$email','$usuario','$senha','$nivel')";
    $retorno = array();
    $operacao_inserir = mysqli_query($conecta, $inserir);

}




$select = " SELECT * from tb_nivel_usuario ";
$consulta = mysqli_query($conecta,$select);
if(!$consulta){
    die("Falha na consulta ao banco de dados");
}



?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Curso PHP Integração com MySQL</title>

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/login.css" rel="stylesheet">
</head>

<body>

    <?php include_once("_incluir/funcoes.php"); ?>

    <main>
        <div id="janela_principal">
            <form action="" id="cadastrar_usuario" method="post">
                <h2>Cadastro</h2>
                <input type="text" name="usuario" id="usuario" placeholder="Usuário" placeholder="Digite o seu usuario">
                <input type="password" name="senha" id="senha" placeholder="Senha" placeholder="Digite a sua senha">
                <input type="email" name="email" id="email" placeholder="Digite o seu Email"></input>


                <td> <select id="nivel" style="width: 150px;" name="nivel">
                        <?php 

                                while($row_banco  = mysqli_fetch_assoc($consulta)){
                                    //declarando as variaveis do banco de dados
                                    $nivelID = $row_banco['nivel_usuarioID'];
                                    $descricao = utf8_encode($row_banco['descricao']);
                                    //declarando as variaveis do banco de dados

                                    $nivelPrincipal = $nivelID;
                                if(!isset($nivel)){
                                
                                ?>
                        <option value="<?php echo $nivelID;?>">
                            <?php echo $descricao;?>
                        </option>
                        <?php
   
                                        }else{

                                            if($nivel==$nivelPrincipal){
                                            ?> <option value="<?php echo $nivelID;?>" selected>
                            <?php echo $descricao;?>
                        </option>

                        <?php
                                            }else{
                                    
                                ?>
                        <option value="<?php echo $nivelID;?>">
                            <?php echo $descricao;?>
                        </option>
                        <?php

                                        }

                                        }

                                        
                                        }

?>
                    </select>

                    <input type="submit" name="cadastrar" placeholder="cadastrar" value="Cadastrar">
                    <?php
                  
                    ?>
                    <div id="footer">
                        <p><a href="login.php">Login<a></a>
                    </div>

        </div>


    </main>
    <script src="jquery.js"></script>
    <script>
    $('#cadastrar_usuario').submit(function(e) {
        e.preventDefault();
        var formulario = $(this);
        var senha = document.getElementById("senha").value;
        if (senha == "") {
            alertify.alert("Favor preencher o campo senha");
        } else {
            var retorno = inserirFormulario(formulario);
        }

    });


    function inserirFormulario(dados) {
        $.ajax({
            type: "POST",
            data: dados.serialize()


        }).then(sucesso, falha);

        function sucesso(data) {

            alertify.success("Usuario cadastrado");

        }

        function falha() {
            console.log("Erro");
        }
    }
    </script>

</body>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>