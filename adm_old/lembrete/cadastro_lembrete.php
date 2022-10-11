<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include ("../_incluir/funcoes.php");
//inportar o alertar js
include('../alert/alert.php');


echo ".";

//consultar estados 
$select = "SELECT usuarioID, usuario from usuarios";
$lista_usuario = mysqli_query($conecta,$select);
if(!$lista_usuario){
    die("Falaha no banco de dados  Linha 19 cadastro_cliente");
}

//consultar cliente
$select = "SELECT clienteID, razaosocial,nome_fantasia from clientes";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}

//consultar cliente
$select = "SELECT statusID, descricao from status_lembrete";
$status_lembrete = mysqli_query($conecta,$select);
if(!$status_lembrete){
    die("Falaha no banco de dados || select clientes");
}


//data lançamento
$hoje = date('Y-m-d'); 

//variaveis 
if(isset($_POST["enviar"])){
  $cliente = utf8_decode($_POST["campoCliente"]);
  $usuario = utf8_decode($_POST["campoUsuario"]);
  $status_Lembrete = utf8_decode($_POST["campoStatusLembrete"]);
  $descricao = utf8_decode($_POST["observacao"]);

  if(isset($_POST['enviar']))
  {
    if($usuario=="1"){
        
            ?>
<script>
alertify.alert("Favor selecione o usuario");
</script>
<?php 
        }elseif($cliente == ("1")){
            
            ?>
<script>
alertify.alert("Favor informar o cliente");
</script>

<?php 

    }else{ 

    ?>
<script>
alertify.success("Lembrete lançado com sucesso!");
</script>
<?php

//inserindo as informações no banco de dados
  $inserir = "INSERT INTO lembrete ";
  $inserir .= "(data_lancamento, descricao,usuarioID,clienteID,statusID)";
  $inserir .= " VALUES ";
  $inserir .= "('$hoje','$descricao',' $usuario',' $cliente','$status_Lembrete' )";


  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
      die("Erro no banco de dados Linha 63 inserir_no_banco_de_dados");
  }

}
} }


?>


<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body>

    <main>
        <form action="cadastro_lembrete.php" autocomplete="off" method="post">
            <div id="titulo">
                </p>Lembrete</p>
            </div>


            <table width=100%>

                <tr>
                    <td style="width: 120px;">Nº Lembrete:</td>
                    <td align=left><input readonly type="text" size="10" id="txtcodigo" name="txtcodcliente" value="">
                    </td>
                </tr>

                <tr>


                    <td align=left> <b>Usuário:</b></td>
                    <td align=left> <select style="width: 168px; margin-right:20px" name="campoUsuario"
                            id="campoUsuario">

                            <?php  while($linha_usuario  = mysqli_fetch_assoc($lista_usuario)){
                                $usuarioPrincipal = utf8_encode($linha_usuario["usuarioID"]);
                               if(!isset($usuario)){
                               
                               ?>
                            <option value="<?php echo utf8_encode($linha_usuario["usuarioID"]);?>">
                                <?php echo utf8_encode($linha_usuario["usuario"]);?>
                            </option>
                            <?php
                               
                               }else{
   
                                if($usuario==$usuarioPrincipal){
                                ?> <option value="<?php echo utf8_encode($linha_usuario["usuarioID"]);?>" selected>
                                <?php echo utf8_encode($linha_usuario["usuario"]);?>
                            </option>

                            <?php
                                         }else{
                                
                               ?>
                            <option value="<?php echo utf8_encode($linha_usuario["usuarioID"]);?>">
                                <?php echo utf8_encode($linha_usuario["usuario"]);?>
                            </option>
                            <?php
   
           }
           
       }
   
                             
   }
      
?>

                        </select>

                        <b>Status:</b>
                        <select style="width: 168px; margin-right:20px;" name="campoStatusLembrete"
                            id="campoStatusLembrete">

                            <?php  while($linha_usuario  = mysqli_fetch_assoc($status_lembrete)){
                                $statusLembretePrincipal = utf8_encode($linha_usuario["statusID"]);
                               if(!isset($status_Lembrete)){
                               
                               ?>
                            <option value="<?php echo utf8_encode($linha_usuario["statusID"]);?>">
                                <?php echo utf8_encode($linha_usuario["descricao"]);?>
                            </option>
                            <?php
                               
                               }else{
   
                                if($status_Lembrete==$statusLembretePrincipal){
                                ?> <option value="<?php echo utf8_encode($linha_usuario["statusID"]);?>" selected>
                                <?php echo utf8_encode($linha_usuario["descricao"]);?>
                            </option>

                            <?php
                                         }else{
                                
                               ?>
                            <option value="<?php echo utf8_encode($linha_usuario["statusID"]);?>">
                                <?php echo utf8_encode($linha_usuario["descricao"]);?>
                            </option>
                            <?php
   
           }
           
       }
   
                             
   }
      
?>

                        </select>

                        <b>Cliente:</b>
                        <select style="width: 500px;" name="campoCliente" id="campoCliente">

                            <?php  while($linha_cliente = mysqli_fetch_assoc($lista_clientes)){
                                $cliente_Principal = utf8_encode($linha_cliente["clienteID"]);
                               if(!isset($cliente)){
                               
                               ?>
                            <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>">
                                <?php echo utf8_encode($linha_cliente["nome_fantasia"]);?>
                            </option>
                            <?php
                               
                               }else{
   
                                if($cliente==$cliente_Principal){
                                ?> <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>" selected>
                                <?php echo utf8_encode($linha_cliente["nome_fantasia"]);?>
                            </option>

                            <?php
                                         }else{
                                
                               ?>
                            <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>">
                                <?php echo utf8_encode($linha_cliente["nome_fantasia"]);?>
                            </option>
                            <?php
   
           }
           
       }
   
                             
   }
      
?>

                        </select>

                    </td>
                </tr>




                <tr>
                    <td align=left><b>Descrição:<b></td>
                    <td><textarea rows=4 cols=300 style="width:600px; height:100px;" name="observacao"
                            id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($descricao);}?></textarea>


                    </td>
                </tr>



                </talbe>
                <table width=100%>
                    <tr>
                        <div style="margin-left:120px" id="botoes">
                            <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>
                            <a href="consulta_lembrete.php">
                                <button type="button" onclick="fechar()" class="btn btn-secondary">Voltar</button>

                            </a>
                        </div>
                    </tr>

        </form>



    </main>
</body>

<?php include '../_incluir/funcaojavascript.jar'; ?>
<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>