<?php
include("../conexao/sessao.php");
require_once("../conexao/conexao.php");
include ("../_incluir/funcoes.php");



//consultar pedido de compra
if($_GET){
    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];
    $pesquisa = $_GET["CampoPesquisa"];
    $pesquisaNpedido = $_GET["CampoPesquisaNpedido"];
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


        $select = "SELECT clientes.nome_fantasia,data_fechamento,pedido_compra.data_movimento, pedido_compra.data_movimento,pedido_compra.valor_total_compra,
        pedido_compra.status_recebimento,  pedido_compra.codigo_pedido, pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, 
        pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_total, 
         pedido_compra.desconto_geral, pedido_compra.valor_total_margem from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID " ;;
        $select  .= " WHERE data_fechamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.nome_fantasia LIKE '%{$pesquisa}%' and 
        pedido_compra.numero_pedido_compra LIKE '%{$pesquisaNpedido}%' ORDER BY  pedido_compra.data_fechamento asc ";
        $lista = mysqli_query($conecta,$select);
        if(!$lista){
            die("Falaha no banco de dados || select");
        }


        $selectValorSoma = $select = "SELECT  clientes.nome_fantasia, sum(valor_total) as soma,  
        sum(valor_total_compra) as somaCompra,data_fechamento, pedido_compra.codigo_pedido,pedido_compra.status_recebimento,pedido_compra.valor_total_compra,  
        pedido_compra.data_movimento,pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, pedido_compra.data_chegada, pedido_compra.entrega_realizada,
        pedido_compra.entrega_prevista, pedido_compra.valor_total,  pedido_compra.desconto_geral,pedido_compra.valor_total_margem from  clientes
        inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID "  ;
        $selectValorSoma  .= " where data_fechamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and 
        clientes.nome_fantasia LIKE '%{$pesquisa}%' and pedido_compra.numero_pedido_compra LIKE '%{$pesquisaNpedido}%' " ;

        $lista_Soma_Valor= mysqli_query($conecta,$selectValorSoma);
        if(!$lista_Soma_Valor){
            die("Falaha no banco de dados || select valor");
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
                    <b> Data Fechamento</b>
                </li>

            </ul>


            <div id="BotaoLancar">


                <a
                    onclick="window.open('cadastro_pdcompra.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1600, HEIGHT=900');">
                    <input id="lancar" type="submit" name="cadastrar_pdcompra" value="Adicionar P.Compra">
                </a>
            </div>
            <form style="width:100%;" action="" method="get">
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

        <form action="consulta_pdcompra.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>D.lançamento</p>
                        </td>
                        <td>
                            <p>N° Pedido</p>
                        </td>

                        <td>
                            <p>Empresa</p>
                        </td>
                        <td>
                            <p>Vlr Compra</p>
                        </td>

                        <td>
                            <p>Desconto</p>
                        </td>

                        <td>
                            <p>Vlr Vnd Total</p>
                        </td>

                        <td>
                            <p>Margem</p>
                        </td>

                        <td>
                            <p>Data Chegada</p>
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


                        <td style="width:350px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($clienteSeleiconado);?> </font>
                            </p>
                        </td>

                        <td style="width:90px;">
                            <font size="2"> <?php echo real_format($valorTotalCompra)?> </font>
                        </td>

                        <td style="width:80px;">
                            <font size="2"> <?php echo ($desconto) . ' %'?> </font>
                        </td>

                        <td style="width:100px;">
                            <font size="2"> <?php echo real_format($valorTotal)?> </font>
                        </td>

                        <td style="width:80px;">
                            <font size="2"> <?php echo porcent_format($lucroL)?> </font>
                        </td>

                        <td style="width:100px;">
                            <font size="2"> <?php if($data_chegada=="0000-00-00") {
                               echo ("");

                                  }elseif($data_chegada=="1970-01-01"){

                                    echo ("");

                                  }elseif($data_chegada==""){

                                    echo ("");

                                  }else{echo formatardataB($data_chegada); } ?></font>
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
                                }
                                ?>
                            </font>
                        </td>

                        <td>

                            <a style="cursor:pointer "
                                onclick="window.open('recebimento.php?codigo=<?php echo $pedidoIDL?>&codigoPedido=<?php echo $codigo_pedido?>&nPedido=<?php echo $nPedidoCompraL?>', 
'recebimento', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
                                <?php if($statusRecebimento==0){
                                    ?>
                                <i style="font-size:22px; color:darkgoldenrod" class="fa-solid fa-calendar"
                                    title="A receber"></i>
                                <?php
                               }else{
                                   ?>
                                <i class="fa-solid fa-calendar-check" style="color:green; font-size:22px"
                                    title="Recebido"></i>
                                <?php
                               }
                               ?>
                            </a>

                        </td>
                        <td id="botaoEditar">
                            <a
                                onclick="window.open('editar_pdcompra.php?codigo=<?php echo $pedidoIDL?>&codigoPedido=<?php echo $codigo_pedido?>',
                                'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO,SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
                                <button type="button" name="Editar">Editar</button>
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
                                <p> <?php  echo real_format($somaCompra); ?></p>
                            </font>
                        </td>
                        <td>
                            <p>
                            </p>
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
                            <font size=2>
                                <p>
                                    <?php 
                                                if($soma==0){
                                                    
                                                }else{
                                                    echo real_percent((($soma-$somaCompra)/$soma)*100);
                                                }
                                                    ?>
                                </p>
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

        </form>

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