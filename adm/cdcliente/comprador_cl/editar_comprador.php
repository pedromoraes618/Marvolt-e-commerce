<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

<?php
require_once("../../conexao/conexao.php");

include("../../conexao/sessao.php");



echo ".";
if(isset($_GET['cliente'])){
$clienteID = $_GET['cliente'];
}

if(isset($_GET['comprador'])){
    $compradorID = $_GET['comprador'];
}

if(isset($_POST['btnsalvar'])){
    $compradorID = $_POST['idComprador'];
    $nComprador = utf8_decode($_POST['momeComprador']);
    $obs = utf8_decode($_POST['observacao']);
    $email = utf8_decode($_POST['email']);
    $contato = utf8_decode($_POST['contato']);
    
    //inlcuir as varias do input

   //query para alterar o cliente no banco de dados
   $alterar = "UPDATE comprador set comprador = '{$nComprador}', email = '{$email}', observacao = '{$obs}',  contato = '{$contato}' where id_comprador = '{$compradorID}' and id_cliente = '{$clienteID}' ";
     $operacao_alterar = mysqli_query($conecta, $alterar);
     if(!$operacao_alterar) {
         die("Erro na alteracao lina 20");   
     } else {  echo ".";
        ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }


   if(isset($_POST['btnremover'])){
   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM comprador WHERE id_comprador = '{$compradorID}' and id_cliente = '{$clienteID}' ";

     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro banco de dados ");   
     } else {   
        ?>
<script>
alertify.error("Cliente removido com sucesso");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }





$consulta = "SELECT * FROM comprador ";
if (isset($_GET["comprador"])){
   $compradorID=$_GET["comprador"];
$consulta .= " WHERE id_comprador = {$compradorID} ";
}else{
   $consulta .= " WHERE id_comprador = 1 ";
}

$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
   $BcompradorID=  utf8_encode($dados_detalhe['id_comprador']);
   $BclienteID=  utf8_encode($dados_detalhe['id_cliente']);
   $Bcomprador =  utf8_encode($dados_detalhe["comprador"]);
   $Bemail = utf8_encode($dados_detalhe["email"]);
   $Bcontato = utf8_encode($dados_detalhe["contato"]);
   $Bobservacao = $dados_detalhe["observacao"];
}




?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form action="" method="post">
            <table width=100%>

                <div id="titulo">
                    </p>Dados comprador</p>
                </div>

                <tr>
                    <td>Código:</td>
                    <td><input readonly type="text" size="10" id="idComprador" name="idComprador" value="<?php echo $BcompradorID;
                            
                            
                            ?>"> </td>
                </tr>



                <tr>

                    <td align=left><input readonly type="hidden" size=20 id="idcliente" name="idcliente" value="<?php echo $BclienteID;
                          
                            
                            ?>
                            "> </td>
                </tr>

                <tr>
                    <td style="width:120px" align=left><b>Comprador:*</b></td>
                    <td align=left><input type="text" required size=53 name="momeComprador" id="momeComprador" value="<?php 
                                echo ($Bcomprador);?>">
                </tr>

                <tr>
                    <td align=left><b>E-mail:</b></td>
                    <td align=left><input type="email" size=53 name="email" id="email" value="<?php echo ($Bemail);
                            ?>">
                </tr>

                <tr>
                    <td align=left><b>Contato:</b></td>
                    <td align=left><input type="text" size=53 name="contato" id="contato" value="<?php  echo $Bcontato;
                            ?>">
                </tr>


                <tr>
                    <td><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao" value="
                    "><?php echo ($Bobservacao);?></textarea>
                    </td>
                </tr>


                </talbe>
                <table width=100%>
                    <tr>
                        <div id="botoes">
                            <input type="submit" name=btnsalvar value="Salvar" class="btn btn-info btn-sm"></input>

                            <a href="consulta_comprador.php?cliente=<?php echo $clienteID;  ?>">
                                <button type="button" class="btn btn-secondary" name="voltar">Voltar</button>
                            </a>

                            <input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Confirma Remoção do comprador?');"></input>

                        </div>
                    </tr>

        </form>



    </main>
</body>


<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>