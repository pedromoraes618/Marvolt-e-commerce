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
$hoje = date('Y-m-d'); 

if(isset($_GET['cliente'])){
$clienteID = $_GET['cliente'];

}

if (isset($_POST['enviar'])){
    $nComprador = utf8_decode($_POST['momeComprador']);
    $obs = utf8_decode($_POST['observacao']);
    $email = utf8_decode($_POST['email']);
    $contato = $_POST['contato'];
  

      //campo obrigatorio 
         
  //inserindo as informações no banco de dados
    $inserir = "INSERT INTO comprador ";
    $inserir .= "(id_cliente,comprador,observacao,email,contato,dataCadastro) ";
    $inserir .= " VALUES ";
    $inserir .= "( '$clienteID','$nComprador','$obs',' $email','$contato','$hoje' )";
  
  
    $nComprador = "";
    $obs = "";
    $email = "";
    $contato = "";

   
    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro no banco de dados ");
    }else{
       
        ?>
<script>
alertify.success("Comprador incluido com sucesso");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   
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
        <form action="cadastro_comprador.php?cliente=<?php echo $_GET['cliente'];?>" method="post">
            <div id="titulo">
                </p>Dados comprador</p>
            </div>


            <table width=100%>

                <tr>

                    <td align=left><input readonly type="hidden" size=20 id="cliente" name="cliente"
                            value="<?php echo $clienteID;?>"> </td>
                </tr>

                <tr>
                    <td style="width:120px" align=left><b>Comprador: *</b></td>
                    <td align=left><input type="text" required="Favor preencher o campo" size=53 name="momeComprador"
                            id="momeComprador" value="<?php if(isset($_POST['enviar'])){
                                echo $nComprador;
                            }?>">
                </tr>

                <tr>
                    <td align=left><b>E-mail:</b></td>
                    <td align=left><input type="email" size=53 name="email" id="email" value="<?php if(isset($_POST['enviar'])){
                                echo $email;
                            }?>">
                </tr>

                <tr>
                    <td align=left><b>Contato:</b></td>
                    <td align=left><input type="text" size=53 data-mask="(00)000000000" name="contato" id="contato"
                            value="<?php if(isset($_POST['enviar'])){
                                echo $contato;
                            }?>">
                </tr>



                <tr>
                    <td><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao" value="
"><?php if(isset($_POST['enviar'])){ echo utf8_encode($obs);}?></textarea>
                    </td>
                </tr>


                </talbe>
                <table width=100%>
                    <tr>
                        <div id="botoes">
                            <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>

                            <a href="consulta_comprador.php?cliente=<?php echo $clienteID?>">
                                <button type="button" class="btn btn-secondary" name="voltar">Voltar</button>

                            </a>

                        </div>
                    </tr>

        </form>



    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
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