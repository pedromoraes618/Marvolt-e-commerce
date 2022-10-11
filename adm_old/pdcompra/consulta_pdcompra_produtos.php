<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include ("../_incluir/funcoes.php");



//consultar pedido de compra
if(isset($_GET["CampoPesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"]){
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


        $select = "SELECT clientes.nome_fantasia,data_fechamento, pedido_compra.data_movimento,pedido_compra.valor_total_compra,pedido_compra.status_recebimento,  pedido_compra.codigo_pedido, pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_total,  pedido_compra.desconto_geral, pedido_compra.valor_total_margem from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID " ;
        $pesquisa = $_GET["CampoPesquisa"];
        $pesquisaNpedido = $_GET["CampoPesquisaNpedido"];
        $select  .= " WHERE data_fechamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and pedido_compra.numero_pedido_compra LIKE '%{$pesquisaNpedido}%'  ";
    
    
       

//consultar cliente

$lista = mysqli_query($conecta,$select);
if(!$lista){
    die("Falaha no banco de dados || select");
}
}

/*
$resultado = mysqli_query($conecta, $pedido);
if(!$resultado){
    die("Falha na consulta ao banco de dados");
    
}
*/
if(isset($_GET["CampoPesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"]){
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

$selectValorSoma = $select = "SELECT  clientes.nome_fantasia, sum(valor_total) as soma,  sum(valor_total_compra) as somaCompra,data_fechamento, pedido_compra.codigo_pedido,pedido_compra.status_recebimento,pedido_compra.valor_total_compra,  pedido_compra.data_movimento,pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_total,  pedido_compra.desconto_geral,pedido_compra.valor_total_margem from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID "  ;
$pesquisa = $_GET["CampoPesquisa"];
$pesquisaNpedido = $_GET["CampoPesquisaNpedido"];

$selectValorSoma  .= " where data_fechamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and pedido_compra.numero_pedido_compra LIKE '%{$pesquisaNpedido}%'   "   ;

$lista_Soma_Valor= mysqli_query($conecta,$selectValorSoma);
if(!$lista_Soma_Valor){
    die("Falaha no banco de dados || select valor");
}else{
    //recuperar valor que está no input 
   

    }
}


//recuperar valores via get
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

            </ul>

            <form style="width:1500px;"  method="get">
                <input style="width: 100px; " type="text" id="CampoPesquisaData" name="CampoPesquisaData"
                    placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if( !isset($_GET["CampoPesquisa"])){ echo formatardataB(date('Y-m-01')); }
                              if (isset($_GET["CampoPesquisaData"])){
                                 echo $pesquisaData;
                                    }?>">
                <input style="width: 100px;" type="text" name="CampoPesquisaDataf" placeholder="Data final"
                    onkeyup="mascaraData(this);" value="<?php if(!isset($_GET["CampoPesquisa"])){ echo date('d/m/Y');
                        } if (isset($_GET["CampoPesquisaDataf"])){ echo $pesquisaDataf;} ?>">

                <input style="width: 100px; margin-left:50px" type="text" name="CampoPesquisaNpedido"
                    placeholder="N° pedido" value="<?php if(isset($_GET['CampoPesquisaNpedido'])){
                        echo $pesquisaNpedido;
                    } ?>">

                <input style="margin-left:110px;" type="text" name="CampoPesquisa" value="<?php if(isset($_GET['CampoPesquisa'])){
                    echo $pesquisa;
                } ?>" placeholder="Pesquisa / Empresa ">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />

            </form>


        </div>

    
            <table border="0" cellspacing="0" id="tabela_pesquisa" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>D.fechamento</p>
                        </td>
                        <td>
                            <p>N° Pedido</p>
                        </td>

                        <td>
                            <p>Empresa</p>
                        </td>


                        <td>
                            <p>Vlr Total</p>
                        </td>
                        <td>
                            <p>Chegou/Total de produtos</p>
                        </td>

                        <td>
                            <p>Entrega Prevista</p>
                        </td>
                        <td>
                            <p>Entrega Realizada</p>
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
 
                    while($linha = mysqli_fetch_assoc($lista)){
                    $pedidoIDL = $linha["pedidoID"];
                    $codigo_pedido = $linha["codigo_pedido"];
                    $dataLancamentoL = $linha["data_movimento"];
                    $data_fechamento = $linha["data_fechamento"];
                    $nPedidoCompraL = $linha["numero_pedido_compra"];
                    $clienteSeleiconado = $linha['nome_fantasia'];
                    $entregaPrevista = $linha["entrega_prevista"];
                    $entregaRealizada = $linha["entrega_realizada"];
                    $data_chegada = $linha["data_chegada"];
                    $desconto = $linha["desconto_geral"];
                    $valorTotal= $linha["valor_total"];
                    $lucroL = $linha["valor_total_margem"];
                    $valorTotalCompra = $linha["valor_total_compra"]; 
                    $statusRecebimento = $linha["status_recebimento"]; 

                    //vericar o total de produtos que estão incluso no pedido de compra
    $select = "SELECT count(data_chegada_prevista) as produto_chegada from tb_pedido_item  where pedidoID = '$codigo_pedido'  ";
    $lista_produto_pedido = mysqli_query($conecta,$select);
    if(!$lista_produto_pedido){
        die("Falha no banco de dados || select produto_pedido");
    }else{
        $linha = mysqli_fetch_assoc($lista_produto_pedido);
        $totalDeProdutos = $linha['produto_chegada'];
       
    }
//vericar o total de produtos que estão com a data de chegada preenchidas
    $select = "SELECT count(data_chegada) as produto_chegada from tb_pedido_item  where pedidoID = '$codigo_pedido' and data_chegada <> '0000.00.00'  ";
    $lista_produto_pedido = mysqli_query($conecta,$select);
    if(!$lista_produto_pedido){
        die("Falha no banco de dados || select produto_pedido");
    }else{
        $linha = mysqli_fetch_assoc($lista_produto_pedido);
        $produtoChegou = $linha['produto_chegada'];
       
    }
                   
                   
                    ?>

                    <tr id="linha_pesquisa">

                        <td style="width:100px;">
                            <font size="2"> <?php if($data_fechamento=="0000-00-00") {
                               echo ("");

                                  }elseif($data_fechamento=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($data_fechamento); } ?></font>
                        </td>
                        <td style="width:90px;">
                            <p>
                                <font size="2"><?php echo $nPedidoCompraL;?></font>
                            </p>
                        </td>


                        <td style="width:450px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($clienteSeleiconado);?> </font>
                            </p>
                        </td>





                        <td style="width:100px;">
                            <font size="2"> <?php echo real_format($valorTotal)?> </font>
                        </td>



                        <td style="width:200px;">
                            <p style="margin-left:50px ;">
                                <font size="2"> <?php 
                                if($totalDeProdutos==$produtoChegou){
                                    ?><p style="color:green;">
                                        <?php echo  $produtoChegou." / ".$totalDeProdutos;?>
                                    </p>
                                    <?php
                                }else{
                                    echo  $produtoChegou." / ".$totalDeProdutos;
                                }
                               ?> </font>
                            </p>
                        </td>


                        <td style="width:120px;">
                            <font size="2"> <?php  
                            if($entregaPrevista=="0000-00-00"){
                                echo ("");
                            }elseif($entregaPrevista=="1970-01-01"){
                                echo ("");
                            } elseif($entregaPrevista==""){
                                echo ("");
                            }else{
                                echo formatardataB($entregaPrevista);
                            }?> </font>

                        </td>

                        <td style="width:130px;">
                            <font size="2">
                                <?php if(($entregaRealizada=="0000-00-00")){
                                 echo ("");
                                   }elseif($entregaRealizada=="1970-01-01"){
                                    echo ("");
                                   }elseif($entregaRealizada==""){
                                    echo ("");
                                   }else{
                                      echo formatardataB($entregaRealizada);
                                      ?>
                                <i style="font-size: 20px; margin-left:10px" title="Entrega realizada!"
                                    class="fa-solid fa-check-double"></i>
                                <?php

                                     } ?>
                            </font>
                        </td>


                        <td style="width:120px;">
                            <font size="2"> <?php if($entregaPrevista!=0000-00-00 and $entregaPrevista < $entregaRealizada){
                                ?><p style="color: red;"> Entrega fora do prazo</p><?php
                                } elseif($entregaRealizada !=0000-00-00 and $entregaPrevista > $entregaRealizada ){
                                    ?><p style="color: blue;"> Entrega antes do prazo</p><?php
                                }elseif($entregaPrevista !=0000-00-00 and $entregaRealizada!=0000-00-00 and $entregaPrevista == $entregaRealizada){
                                    ?><p style="color: green;"> Entrega no Prazo</p><?php
                                }elseif($entregaRealizada!=0000-00-00){
                                    ?><p style="color: green;"> Entrega já realizada</p><?php
                                }else{
                                    if($totalDeProdutos==$produtoChegou){
                                        ?><p style="color:green;">
                                    <?php echo  "Pronto para a entrega"?>
                                </p>
                                <?php
                                }}
                                ?>
                            </font>
                        </td>

                        <td>


                        </td>
                        <td id="botaoEditar">
                            <a
                                onclick="window.open('produtos_pedido_compra.php?codigo=<?php echo $pedidoIDL?>&codigoPedido=<?php echo $codigo_pedido?>',
                                'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO,SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
                                <button type="button" name="Editar">Produtos</button>
                            </a>
                        </td>



                    </tr>

                    <?php
                    }

              while($linha_Soma_Valor = mysqli_fetch_assoc($lista_Soma_Valor)){
                $soma = $linha_Soma_Valor['soma'];
                $somaCompra = $linha_Soma_Valor['somaCompra'];
        
                
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
                        <font size="2">
                                <p>
                                    <?php 
                
                              echo real_format($soma);
                    
                          ?> </p>
                            </font>
                        </td>
                        <td>
                            
                        </td>

                        <td>

                        </td>


                        <td>

                        </td>

                        <td>

                        </td>


                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>

                    <?php

                    }
             }
            
            ?>
                </tbody>
            </table>

    

    </main>


</body>





</html>

<script>
//abrir uma nova tela de cadastro

function abrepopupEditarPcompra() {

    var janela = "editar_pdcompra.php?codigo=<?php echo $pedidoIDL?>";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupAdicionarPcompra() {

    var janela = "cadastro_pdcompra.php";
    window.open(janela, 'popuppageCadastar',
        'width=1700,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>