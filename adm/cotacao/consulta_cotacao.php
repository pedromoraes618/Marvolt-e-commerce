<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");
include ("../_incluir/funcoes.php");

//consultar status
$select = "SELECT * from situacao_proposta ";
$lista = mysqli_query($conecta,$select);
if(!$lista){
    die("Falaha no banco de dados || tabela situacao_proposta");
}


//consultar cotacao
if(isset($_GET["CampoPesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"])  {

    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];
  
    if($pesquisaData==""){
          
    }else{
        $div1 = explode("/",$_GET['CampoPesquisaData']);
        $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
       
    }
    if($pesquisaDataf==""){
       
    }else{
    $div2 = explode("/",$_GET['CampoPesquisaDataf']);
    $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
    }
    
    $select = " SELECT cotacao.numero_orcamento,cotacao.numero_solicitacao,cotacao.cotacaoID,cotacao.data_lancamento, cotacao.status_proposta, cotacao.compradorID, cotacao.desconto,cotacao.valorTotalComDesconto, cotacao.cod_cotacao, clientes.clienteID, clientes.nome_fantasia as cliente,situacao_proposta.descricao as situacao, cotacao.validade,cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID " ;
    $pesquisa = $_GET["CampoPesquisa"];
    $situacao = $_GET['campoSituacao'];
    $pesquisaNorcamento = $_GET["CampoPesquisaNorcamento"];
    if($situacao == 1){
        $select .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and cotacao.numero_orcamento  LIKE '%{$pesquisaNorcamento}%' order by cotacao.numero_orcamento  ";
    }else{
        $select .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and cotacao.numero_orcamento  LIKE '%{$pesquisaNorcamento}%' and cotacao.status_proposta LIKE '%{$situacao}%' order by cotacao.numero_orcamento  ";
    }
  
    $resultado = mysqli_query($conecta, $select);
    if(!$resultado){
        die("Falha na consulta ao banco de dados");
        
    }else{
        
    }
}


     if(isset($_GET["CampoPesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"])  {

        $pesquisaData = $_GET["CampoPesquisaData"];
        $pesquisaDataf = $_GET["CampoPesquisaDataf"];
   

        if($pesquisaData==""){
              
        }else{
            $div1 = explode("/",$_GET['CampoPesquisaData']);
            $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
           
        }
        if($pesquisaDataf==""){
           
        }else{
        $div2 = explode("/",$_GET['CampoPesquisaDataf']);
        $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
        }
    
        $selectSoma = "  SELECT cotacao.numero_orcamento, cotacao.numero_solicitacao,cotacao.cotacaoID,cotacao.data_lancamento,sum(valorTotalComDesconto) as soma, 
        cotacao.status_proposta, cotacao.compradorID, cotacao.desconto,cotacao.valorTotalComDesconto, cotacao.cod_cotacao, 
        clientes.clienteID, clientes.nome_fantasia as cliente,situacao_proposta.descricao as situacao, cotacao.validade,
        cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes 
        inner join cotacao on cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID  ";

        $pesquisa = $_GET["CampoPesquisa"];
        $pesquisaNorcamento = $_GET["CampoPesquisaNorcamento"];
        $situacao = $_GET['campoSituacao'];
        
        if($situacao == 1){
            $selectSoma .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and
             cotacao.numero_orcamento  LIKE '%{$pesquisaNorcamento}%' order by cotacao.numero_orcamento  ";
        }else{
            $selectSoma .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and
             cotacao.numero_orcamento  LIKE '%{$pesquisaNorcamento}%'  and  cotacao.status_proposta LIKE '%{$situacao}%' order by cotacao.numero_orcamento  ";
        }
        $lista_Soma_Valor = mysqli_query($conecta, $selectSoma);
        if(!$lista_Soma_Valor){
            die("Falha na consulta ao banco de dados");
        }
    }
    
        if (isset($_GET["CampoPesquisaData"])){
        $pesquisaData=$_GET["CampoPesquisaData"];
        }
        if (isset($_GET["CampoPesquisaDataf"])){
        $pesquisaDataf=$_GET["CampoPesquisaDataf"];
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
            <ul>
                <li>
                    <b> Data lançamento</b>
                </li>
                <li style="margin-left: 810px;">
                    <b> Situação</b>
                </li>



            </ul>



            <form action="" style="width:100%;" method="get">
                <a
                    onclick="window.open('cadastro_cotacao.php', 
'Cadastro_cotacao', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1600, HEIGHT=900');">
                    <input type="submit" name="cadastrar_cotacao" value="Adicionar">
                </a>
                <a
                    onclick="window.open('cadastro_cotacao_avulso.php', 
'Cadastro_cotacao', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1600, HEIGHT=900');">
                    <input type="submit"  name="cadastrar_cotacao" value="Avulso" style="margin-right:20px ;">
                </a>

                <input style="width: 100px; " type="text" id="CampoPesquisaData" name="CampoPesquisaData"
                    placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if( !isset($_GET["CampoPesquisaData"])){ echo formatardataB(date('Y-m-01')); }
                              if (isset($_GET["CampoPesquisaData"])){
                                 echo $pesquisaData;
                     }?>">

                <input style=" width: 100px;" type="text" name="CampoPesquisaDataf" placeholder="Data final"
                    onkeyup="mascaraData(this);" value="<?php if(!isset($_GET["CampoPesquisaDataf"])){ echo date('d/m/Y');
                    } if (isset($_GET["CampoPesquisaDataf"])){ echo $pesquisaDataf;} ?>">

                <input style="width: 100px; margin-left:50px" type="text" name="CampoPesquisaNorcamento"
                    placeholder="N° Orçamento" value="<?php if(isset($_GET['CampoPesquisaNorcamento'])){
                        echo $pesquisaNorcamento;
                    } ?>">

                <input style="margin-left:110px;" type="text" name="CampoPesquisa" value="<?php if(isset($_GET['CampoPesquisa'])){echo $pesquisa;
                } ?>" placeholder="Pesquisa / Empresa">

                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />
                <td>
                    <select style="width: 170px; margin-top:0px; float:right; margin-right:100px; " id="campoLancamento"
                        name="campoSituacao">
                        <option value="1">Selecione</option>
                        <?php 
                            
                               
                             while($linha_situacao_proposta  = mysqli_fetch_assoc($lista)){
                                $receita_despesa_principal = utf8_encode($linha_situacao_proposta["statusID"]);
                               if(!isset($situacao)){
                               
                               ?>
                        <option value="<?php echo utf8_encode($linha_situacao_proposta["statusID"]);?>">
                            <?php echo utf8_encode($linha_situacao_proposta["descricao"]);?>
                        </option>
                        <?php
                               
                               }else{
   
                                if($situacao==$receita_despesa_principal){
                                ?> <option value="<?php echo utf8_encode($linha_situacao_proposta["statusID"]);?>"
                            selected>
                            <?php echo utf8_encode($linha_situacao_proposta["descricao"]);?>
                        </option>

                        <?php
                                         }else{
                                
                               ?>
                        <option value="<?php echo utf8_encode($linha_situacao_proposta["statusID"]);?>">
                            <?php echo utf8_encode($linha_situacao_proposta["descricao"]);?>
                        </option>
                        <?php
   
           }
           
       }
   
                             
   }
   
                         ?>


                    </select>
                </td>
            </form>


        </div>

        <form action="" method="get">

            <table border="0" cellspacing="0" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">

                        <td>
                            <p>N°Orç</p>
                        </td>
                        <td>
                            <p>N°Sol</p>
                        </td>
                        <td>
                            <p>D.Lançamento</p>
                        </td>

                        <td>
                            <p>Empresa</p>
                        </td>
                        <td>
                            <p>Proposta</p>
                        </td>

                        <td>
                            <p>Validade</p>
                        </td>

                        <td>
                            <p>Data a responder</p>
                        </td>
                        <td>
                            <p>Data envio</p>
                        </td>
                        <td>
                            <p>Fechamento</p>
                        </td>
                        <td>
                            <p>Desconto</p>
                        </td>
                        <td>
                            <p>Valor</p>
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                    </tr>


                    <?php  
        if(isset($_GET["CampoPesquisaData"])){
           while($linha = mysqli_fetch_assoc($resultado)){
                
            $cotacaoID = $linha["cotacaoID"];
            $codCotacao = $linha["cod_cotacao"];
            $nOrcamento = $linha["numero_orcamento"];
            $cliente = $linha["cliente"];
            $clienteID = $linha["clienteID"];
            $situacao = $linha["situacao"];
            $status = $linha["status_proposta"];
            $validade = $linha["validade"];
            $data = $linha["data_lancamento"];
            $dataResponder = $linha["data_responder"];
            $DataEnvio = $linha["data_envio"];
            $DataFechamento = $linha["data_fechamento"];
            $desconto = $linha['desconto'];
            $valor = $linha['valorTotalComDesconto'];
            $comprador = $linha['compradorID'];
            $nSolicitacao = $linha['numero_solicitacao'];
            
            
            
          
         

         
           ?>

                    <tr id="linha_pesquisa">

                        <td style="width: 70px;">
                            <font size="2"><?php echo $nOrcamento;?></font>
                        </td>
                        <td style="width: 70px;">
                            <font size="2"><?php echo $nSolicitacao;?></font>
                        </td>
                        <td style="width: 70px;">
                            <font size="2"> <?php if($data=="0000-00-00") {
                               echo ("");

                                  }elseif($data=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($data); } ?></font>
                        </td>


                        <td style="width: 500px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($cliente);?> </font>
                            </p>
                        </td>
                        <td style="width:100px;">
                            <font size="2"><?php echo utf8_encode($situacao);?></font>
                        </td>


                        <td style="width: 90px;">
                            <font size="2"><?php echo utf8_encode($validade);?> </font>
                        </td>

                        <td style="width: 150px;">
                            <font size="2"> <?php if($dataResponder=="0000-00-00") {
                               echo ("");

                                  }elseif($dataResponder=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataResponder); } ?></font>
                        </td>

                        <td style="width: 100px;">
                            <font size="2"><?php if($DataEnvio=="0000-00-00") {
                               echo ("");

                                  }elseif($DataEnvio=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($DataEnvio); } ?> </font>
                        </td>

                        <td style="width: 100px;">
                            <font size="2"> <?php if($DataFechamento=="0000-00-00") {
                               echo ("");

                                  }elseif($DataFechamento=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($DataFechamento); } ?></font>
                        </td>
                        <td style="width: 100px;">
                            <font size="2"><?php echo $desconto ?></font>
                        </td>
                        <td style="width: 100px;">
                            <font size="2"><?php echo real_format($valor) ?></font>
                        </td>
                        <td style="width: 40px;">
                            <font size="3"><?php if(($status==4) or ($status==3)){?>
                                <i style="color:green ;" class="fa-solid fa-handshake" title="Ganho"></i>
                                <?php
                            }elseif($status==5){
                                ?>
                                <i style="color:brown;" class="fa-solid fa-x" title="Perdido"></i>
                                <?php
                            } ?>
                            </font>
                        </td>

                        <td style="width: 50px;">
                            <a target="blank"
                                href="pdfCotacao.php?codigo=<?php echo $codCotacao; ?>&cliente=<?php echo $clienteID;?>&compradorID=<?php echo $comprador;?>">
                                <img src="../images/icons8-pdf-64.png" title="Gerar pdf">
                            </a>
                        </td>

                        <td id="botaoEditar">


                            <a
                                onclick="window.open('editar_cotacao.php?codigo=<?php echo $cotacaoID;?>&cotacaoCod=<?php echo $codCotacao;?>', 
'Editar_cotacao', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1600, HEIGHT=900');">

                                <button type="button" name="editar">Editar</button>
                            </a>

                        </td>


                    </tr>
                    <?php

                    }

                   
           
           while($linha_Soma_Valor = mysqli_fetch_assoc($lista_Soma_Valor)){
            $soma = $linha_Soma_Valor['soma'];
        
            
                    ?>

                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Total</p>
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>


                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                        <td>
                            <p> </p>
                        </td>

                        <td>
                            <p></p>
                        </td>
                        <td style="width: 140px;">
                            <p><?php echo real_format($soma); ?></p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                        <td>
                            <p></p>
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
<?php include '../_incluir/funcaojavascript.jar'; ?>
<script>
//abrir uma nova tela de cadastro
function abrepopupCadastroProduto() {

    var janela = "cadastro_produto.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupEditarProduto() {

    var janela = "editar_produto.php?codigo=<?php echo $idProduto ?>";
    window.open(janela, 'popuppageEditarProduto',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>