<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include ("../_incluir/funcoes.php");
include ("../classes/pdcompra/editar_pedido_compra.php");

?>


<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

</head>

<body>

    <main>
        <form action="" method="post">
            <div id="titulo">
                </p>Editar Pedido de Compra</p>
            </div>



            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="cammpoPedidoID" name="cammpoPedidoID"
                            value="<?php echo $BpedidoID ?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Nº Pedido:</b></td>
                    <td align=left><input type="text" size=20 name="campoNpdCompra"
                            value="<?php echo $BnumeroPedidoCompra ?>" td>

                        <b>Nº Orçamento:</b>
                        <input type="text" size=14 id="campoOrcamento" name="campoOrcamento"
                            value="<?php echo $BnumeroOrcamento?>">


                    <td><b>Nº NFE:</b></td>
                    <td><input type="text" size=20 id="campoNnfe" name="campoNnfe"
                            value="<?php echo $BnumeroNfe?>"><b>Data
                            Pagamento:</b>
                        <input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento" value="<?php

                        
                            if($BdataPagamento=="1970-01-01"){
                                print_r("");
                            }elseif($BdataPagamento=="0000-00-00"){
                                print_r ("");
                            }
                            elseif($BdataPagamento==""){
                                print_r ("");
                            }else{
                                echo formatardataB($BdataPagamento);}?>" OnKeyUp="mascaraData(this);" maxlength="10"
                            autocomplete="off">

                </tr>

                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left><select id="campoCliente" name="campoCliente">
                            <?php 

                             $meuCliente =  $Bcliente ;
                           while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                               $formaClientePrincipal = utf8_encode($linha_clientes["clienteID"]);

                               if($meuCliente==$formaClientePrincipal){
                                   ?> <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>" selected>
                                <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                            </option>

                            <?php
                                   }else{
                                       ?>
                            <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                <?php echo utf8_encode($linha_clientes["nome_fantasia"]);?>
                            </option>
                            <?php

                                   }
                                   

                         }
                         
                         ?>


                        </select>
                    </td>


                    <td><b>Forma do pagamento:</b></td>
                    <td><select style="width: 205px;" id="campoFormaPagamento" name="campoFormaPagamento">
                            <?php 

                             $meuFomraPagmaneto =  $BformaPagamento ;
                           while($linha_formapagamento = mysqli_fetch_assoc($lista_formapagamemto)){
                               $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);

                               if($meuFomraPagmaneto==$formaPagamentoPrincipal){
                                   ?>

                            <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>"
                                selected>
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>

                            <?php
                                   }else{
                                       ?>
                            <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>
                            <?php

                                   }
                                   

                         }
                         
                         ?>

                        </select>

                    </td>
                </tr>

                <tr>
                    <td align=left><b>Produto:</b></td>
                    <td align=left><input type="text" size=57 name="campoProduto" id="campoProduto"
                            value="<?php echo $Bproduto?>"><i id="botaoPesquisar"
                            class="fa-solid fa-magnifying-glass-plus"></i> </td>

                    <td>
                        <b>Status da compra:</b>
                    </td>
                    <td>

                        <select id="campoStatusCompra" name="campoStatusCompra">
                            <?php 

                                $meuStatusCompra = $BstatusCompra;
                                while($linha_statusCompra = mysqli_fetch_assoc($lista_statuscompra )){
                                $statusCompraPrincipal = utf8_encode($linha_statusCompra["nome"]);

                                if($meuStatusCompra == $statusCompraPrincipal){

                        ?>
                            <option value="<?php echo utf8_encode($linha_statusCompra["nome"]);?>" selected>
                                <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                            </option>

                            <?php

                         }else{
                             ?>
                            <option value="<?php echo utf8_encode($linha_statusCompra["nome"]);?>">
                                <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                            </option>
                            <?php
                         }
                        }
                         
                         ?>

                        </select>

                        <b style="margin-left: 20px;">Data Compra:</b>
                        <input style="margin-left: 27PX;" type="text" size=20 id="campoDataCompra"
                            name="campoDataCompra" value="<?php 
                        
                        
                        if($BdataCompra=="1970-01-01"){
                            print_r("");
                        }elseif($BdataCompra=="0000-00-00"){
                            print_r ("");
                        }elseif($BdataCompra==""){
                            print_r ("");
                        }else{
                            echo formatardataB($BdataCompra);}?>" OnKeyUp="mascaraData(this);" maxlength="10"
                            autocomplete="off">

                    </td>


                </tr>

                <tr>
                    <td align=left><b>Unidade:</b></td>
                    <td align=left><input type="text" size=18 name="CampoUnidade" id="CampoUnidade"
                            value="<?php echo $Bunidade ?>"><b>Quantidade:</b>
                        <input type="text" size=19 name="CampoQuantidade" id="CampoQuantidade"
                            value="<?php echo $Bquantidade?>">
                    </td>


                    <td align=left><b>Data chegada:</b></td>
                    <td align=left><input type="text" size=20 name="CampoDataChegada" id="CampoDataChegada" value="<?php
                    
                    if($BdataChegada=="1970-01-01"){
                                print_r ("");
                            }elseif($BdataChegada=="0000-00-00"){
                                print_r ("");
                            }elseif($BdataChegada==""){
                                print_r ("");
                            }else{
                                echo formatardataB($BdataChegada);}
                                ?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off"><b>Entrega
                            Prevista:</b>

                        <input type="text" size=20 id="CampoEntregaPrevista" name="CampoEntregaPrevista" value="<?php 
                             if($BentregaPrevista=="1970-01-01"){
                                print_r("");
                            }elseif($BentregaPrevista=="0000-00-00"){
                                print_r ("");
                            }elseif($BentregaPrevista==""){
                                print_r ("");
                            }else{
                                echo formatardataB($BentregaPrevista); }?>" OnKeyUp="mascaraData(this);" maxlength="10"
                            autocomplete="off">
                    </td>


                </tr>


                <tr>
                    <td align=left> <b>Preço Compra:</b></td>
                    <td align=left> <input type="text" size=18 id="campoPrecoCompra" name="campoPrecoCompra"
                            onblur="calculavalormargem()" value="<?php echo $BprecoCompra ?>">

                        <b>Preço Venda:</b>

                        <input type="text" size=17 name="campoPrecoVenda" id="campoPrecoVenda"
                            onblur="calculavalormargem()" value="<?php echo $BprecoVenda?>">
                    </td>




                    <td> <b style="margin-left: 20px;">Entrega Realizada:</b></td>
                    <td> <input type="text" size=20 id="CampoEntregaRealizada" name="CampoEntregaRealizada" value="<?php
                             if($BentregaRealizada=="1970-01-01"){
                                print_r("");
                            }elseif($BentregaRealizada=="0000-00-00"){
                                print_r ("");
                            }elseif($BentregaRealizada==""){
                                print_r ("");
                            }else{
                                echo  formatardataB($BentregaRealizada);}?>" OnKeyUp="mascaraData(this);"
                            maxlength="10" autocomplete="off">


                    </td>

                </tr>

                <tr>

                    <td align=left><b>Margem:</b></td>
                    <td align=left><input type="text" size=18 name="campoMargem" id="campoMargem"
                            onblur="calculavalormargem()" value="<?php echo $Bmargem?>"><b>Desconto:</b>
                        <input type="text" size=16 id="campoDesconto" name="campoDesconto"
                            value="<?php echo $Bdesconto?>">
                    </td>

                </tr>


                <tr>
                    <td align=left><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao"><?php echo $Bobservacao?></textarea>


                    </td>
                </tr>


                <table width=100%>
                    <tr>
                        <div id="botoes">

                            <input type="submit" name="btnsalvar" value="Salvar" class="btn btn-info btn-sm"></input>


                            <button type="button" onclick="fechar();" class="btn btn-secondary">Voltar</button>



                            <input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Confirma Remoção do pedido de compra?');"></input>



                        </div>
                    </tr>

                    </talbe>



        </form>

        </talbe>




    </main>
</body>


</html>



<script>
function calculavalormargem() {
    var campoPrecoVenda = document.getElementById("campoPrecoVenda").value;
    var campoPrecoCompra = document.getElementById("campoPrecoCompra").value;
    var campoMargem = document.getElementById("campoMargem");
    var calculo;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCompra = parseFloat(campoPrecoCompra);

    calculo = (((campoPrecoVenda - campoPrecoCompra) / campoPrecoVenda) * 100).toFixed(2);;
    campoMargem.value = calculo;
}
</script>


<script>
function fechar() {
    window.close();
}
</script>

<?php 
include '../_incluir/funcaojavascript.jar'; 
?>

<?php 
mysqli_close($conecta);
?>