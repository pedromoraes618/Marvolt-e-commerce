<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");


$select = "SELECT statusID, descricao from status_lembrete";
$status_lembrete = mysqli_query($conecta,$select);
if(!$status_lembrete){
    die("Falaha no banco de dados || select clientes");
}


if(isset($_GET["campoStatusLembrete"])){   
    //consultar
//consultar 
$lembrete = "SELECT  lembrete.lembreteID,  lembrete.data_lancamento, lembrete.descricao as descricaoNome, clientes.razaosocial  as clienteNome, clientes.nome_fantasia as nomeFantasia, usuarios.usuario AS usariosNome, status_lembrete.descricao as statusNomeLembrete from clientes inner join  lembrete on lembrete.clienteID = clientes.clienteID INNER Join status_lembrete on lembrete.statusID = status_lembrete.statusID INNER Join usuarios on lembrete.usuarioID = usuarios.usuarioID ";
$pesquisa = $_GET["campoPesquisa"];
$statusLembreteID = $_GET["campoStatusLembrete"];
$lembrete .= " where lembrete.statusID = $statusLembreteID and clientes.razaosocial LIKE '%{$pesquisa}%'  ";

$resultado = mysqli_query($conecta, $lembrete);
if(!$resultado){
    die("Falha na consulta ao banco de dados");
    
}
}


?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/estilo.css" rel="stylesheet">
    <link href="../_css/pesquisa_tela.css" rel="stylesheet">

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>

        <div id="janela_pesquisa">

            <a
                onclick="window.open('cadastro_lembrete.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=600');">
                <input type="submit" name="cadastar_cliente" value="Adicionar">
            </a>


            <form style="width:1500px;" action="consulta_lembrete.php" method="get">


                <input style="margin-left:500px;" type="text" name="campoPesquisa" value="<?php if(isset($_GET['campoStatusLembrete'])){
                    echo $pesquisa;
                } ?>" placeholder="Pesquisa / Empresa / Estatus">

                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />


                <select style=" float:right; margin-right:150px; " name="campoStatusLembrete" id="campoStatusLembrete">



                    <?php  while($linha_usuario  = mysqli_fetch_assoc($status_lembrete)){
                                $statusLembretePrincipal = utf8_encode($linha_usuario["statusID"]);
                               if(!isset($statusLembreteID)){
                               
                               ?>
                    <option value="<?php echo utf8_encode($linha_usuario["statusID"]);?>">
                        <?php echo utf8_encode($linha_usuario["descricao"]);?>
                    </option>
                    <?php
                               
                               }else{
   
                                if($statusLembreteID==$statusLembretePrincipal){
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


            </form>


        </div>

        <form action="consulta_lembrete.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">


                        <td>
                            <p>Nº L</p>
                        </td>
                        <td>
                            <p>Data lancamento</p>
                        </td>

                        <td>
                            <p>Usuário</p>
                        </td>
                        <td>
                            <p>Descrição</p>
                        </td>
                        <td>
                            <p>Empresa</p>
                        </td>


                        <td>
                            <p>Status</p>
                        </td>


                        <td>
                            <p></p>
                        </td>



                    </tr>
                    <?php   if(isset($_GET["campoPesquisa"])){
           while($linha = mysqli_fetch_assoc($resultado)){
                
                
            $lembreteID = $linha["lembreteID"];
            $usuario = $linha["usariosNome"];
            $descricao = $linha["descricaoNome"];
            $cliente = $linha["nomeFantasia"];
            $status = $linha["statusNomeLembrete"];
            $dataLancamento = $linha["data_lancamento"];
            
            
         

         
           ?>


                    <tr id="linha_pesquisa">

                        <td style="width:80px;">
                            <p>
                                <font size="3"><?php echo $lembreteID;?>
                                </font>
                            </p>
                        </td>


                        <td style="width:150px;">
                            <font size="2"> <?php if($dataLancamento=="0000-00-00") {
                               echo ("");

                                  }elseif($dataLancamento=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataLancamento); } ?></font>
                        </td>

                        <td style="width:100px;">
                            <font size="2"><?php echo utf8_encode($usuario)?></font>
                        </td>
                        <td style="width:350px;">
                            <font size="2"> <?php echo utf8_encode($descricao)?>
                            </font>
                        </td>

                        <td style="width:400px;">
                            <font size="2"> <?php echo utf8_encode($cliente)?></font>
                        </td>

                        <td style="width:80px;">
                            <font size="2"> <?php echo utf8_encode($status)?></font>
                        </td>



                        <td id="botaoEditar">



                            <a
                                onclick="window.open('editar_lembrete.php?codigo=<?php echo $lembreteID?>', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                                <button type="button" name="Editar">Editar</button>

                            </a>


                        </td>
                    </tr>



                    <?php
             }
            }
            ?>
                </tbody>
            </table>

        </form>

    </main>

</body>

<script>
//abrir uma nova tela de cadastro
function abrepopupcliente() {

    var janela = "cadastro_cliente.php";
    window.open(janela, 'popuppageCadastrar',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupEditarCliente() {

    var janela = "editar_cliente.php?codigo=<?php  
       if(isset($_GET["cliente"])){
        while($linha = mysqli_fetch_assoc($resultado)){
         $Idcliente = $linha["clienteID"];
        
        }
    }

    ?>";
    window.open(janela, 'popuppageEditar',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>