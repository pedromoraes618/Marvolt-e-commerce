<head>
    <meta charset="UTF-8">
</head>
<nav id="cabecalho">
    <ul>

        <li>
            Lembrete de contas a Receber <i style="color:green; font-size:18px"
                class="fa-solid fa-face-grin-beam"> </i>
        </li>
    </ul>
</nav>
<table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
    <tbody>

        <tr id="cabecalho_pesquisa_consulta">

            <td>
                <p>Data Vencimento</p>
            </td>

            <td>
                <p>Empresa</p>
            </td>
            <td>
                <p>Descrição</p>
            </td>
            <td>
                <p>Valor</p>
            </td>

            <td>
                <p>SubGrupo</p>
            </td>

            <td>
                <p>Nº doc</p>
            </td>
            <td>
                <p>Atraso</p>
            </td>

        </tr>

        <?php

                    while($linha_pesquisa = mysqli_fetch_assoc($lista_pesquisa)){
                    $dataPagamento = $linha_pesquisa["data_do_pagamento"];
                    $dataVencimentoL = $linha_pesquisa["data_a_pagar"];
                    $clienteL = $linha_pesquisa['nome_fantasia'];
                    $descricao = $linha_pesquisa['descricao'];
                    $statusL = $linha_pesquisa["status"];
                    $subGrupo = ($linha_pesquisa["subgrupo"]);
                    $grupo = utf8_encode($linha_pesquisa["grupo"]);
                    $valorL = $linha_pesquisa["valor"];
                    $documentoL = $linha_pesquisa["documento"];
                    $receite_despesa = $linha_pesquisa["receita_despesa"];
                    $lancamentoID = $linha_pesquisa["lancamentoFinanceiroID"];
                    $atraso = $linha_pesquisa["atraso"];
                    
                   
                    ?>

        <tr id="linha_pesquisa">
            <?php
                        ?>
            <td style="width: 100px;">
                <p>
                    <font size="2"> <?php if($dataVencimentoL=="0000-00-00") {
                               echo ("");

                                  }elseif($dataVencimentoL=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataVencimentoL); } ?></font>
                </p>
            </td>

            <td style="width:300px;">
                <p>
                    <font size="2"><?php echo utf8_encode($clienteL)?></font>
                </p>
            </td>
            <td style="width:350px;">
                <font size="2"><?php echo utf8_encode($descricao)?></font>
            </td>


            <td style="width:200px;">
                <font size="2"> <?php echo real_format($valorL)?></font>
            </td>


            <td style="width:170px;">
                <font size="2"> <?php echo utf8_encode($subGrupo) ." - ". $grupo?></font>
            </td>


            <td style="width:90px;">
                <font size="2"> <?php echo utf8_encode($documentoL)?> </font>
            </td>


            <td style="width:90px;">
                <font size="2"><?php 
                            if($atraso <= 0 ){

                            }else{
                                ?>
                    <p style="color:red ;"><?php 
                                echo $atraso;
                                 ?>
                    </p>
                    <?php
                                }
                                
                                ?>
                </font>
            </td>

        </tr>
        <?php
                }
             
            ?>
    </tbody>
</table>


<!-- contas a pagar -->
<nav id="cabecalho">
    <ul>
        <li>
            Lembrete de contas a Pagar <i style="color:darkgoldenrod; font-size:18px"
                class="fa-solid fa-face-grimace"></i>

        </li>
    </ul>
</nav>
<table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
    <tbody>

        <tr id="cabecalho_pesquisa_consulta">

            <td>
                <p>Data Vencimento</p>
            </td>

            <td>
                <p>Empresa</p>
            </td>
            <td>
                <p>Descrição</p>
            </td>
            <td>
                <p>Valor</p>
            </td>

            <td>
                <p>SubGrupo</p>
            </td>

            <td>
                <p>Nº doc</p>
            </td>
            <td>
                <p>Atraso</p>
            </td>

        </tr>

        <?php

                    while($linha_pesquisa = mysqli_fetch_assoc($lista_pesquisa_pagar)){
                    $dataPagamento = $linha_pesquisa["data_do_pagamento"];
                    $dataVencimentoL = $linha_pesquisa["data_a_pagar"];
                    $clienteL = $linha_pesquisa['nome_fantasia'];
                    $descricao = $linha_pesquisa['descricao'];
                    $statusL = $linha_pesquisa["status"];
                    $subGrupo = ($linha_pesquisa["subgrupo"]);
                    $grupo = utf8_encode($linha_pesquisa["grupo"]);
                    $valorL = $linha_pesquisa["valor"];
                    $documentoL = $linha_pesquisa["documento"];
                    $receite_despesa = $linha_pesquisa["receita_despesa"];
                    $lancamentoID = $linha_pesquisa["lancamentoFinanceiroID"];
                    $atraso = $linha_pesquisa["atraso"];
                    
                   
                    ?>

        <tr id="linha_pesquisa">
            <?php
                        ?>
            <td style="width: 100px;">
                <p>
                    <font size="2"> <?php if($dataVencimentoL=="0000-00-00") {
                               echo ("");

                                  }elseif($dataVencimentoL=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataVencimentoL); } ?></font>
                </p>
            </td>

            <td style="width:300px;">
                <p>
                    <font size="2"><?php echo utf8_encode($clienteL)?></font>
                </p>
            </td>
            <td style="width:350px;">
                <font size="2"><?php echo utf8_encode($descricao)?></font>
            </td>


            <td style="width:200px;">
                <font size="2"> <?php echo real_format($valorL)?></font>
            </td>


            <td style="width:170px;">
                <font size="2"> <?php echo utf8_encode($subGrupo) ." - ". $grupo?></font>
            </td>


            <td style="width:90px;">
                <font size="2"> <?php echo utf8_encode($documentoL)?> </font>
            </td>


            <td style="width:90px;">
                <font size="2"><?php 
                            if($atraso <= 0 ){

                            }else{
                                ?>
                    <p style="color:red ;"><?php 
                                echo $atraso;
                                 ?>
                    </p>
                    <?php
                                }
                                
                                ?>
                </font>
            </td>

        </tr>
        <?php
                }
             
            ?>
    </tbody>
</table>

<!-- Recebimento para pedido de compra -->
<nav id="cabecalho">
    <ul>

        <li>
            Lembrete para o recebimento da Pedido de compra <i style="color:darkgoldenrod; font-size:18px"
                class="fa-solid fa-face-grimace"></i>


        </li>
    </ul>
</nav>
<table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
    <tbody>

        <tr id="cabecalho_pesquisa_consulta">

            <td>
                <p>Data Entrega</p>
            </td>

            <td>
                <p>Empresa</p>
            </td>
            <td>
                <p>Descricao</p>
            </td>
            <td>
                <p>Valor</p>
            </td>

        </tr>

        <?php

    while($linha = mysqli_fetch_assoc($lista_pesquisa_recebemento)){
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
            <?php
                        ?>
            <td style="width: 100px;">
                <p>
                    <font size="2"> <?php if($entregaRealizada=="0000-00-00") {
                               echo ("");

                                  }elseif($entregaRealizada=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($entregaRealizada); } ?></font>
                </p>
            </td>

            <td style="width:300px;">
                <p>
                    <font size="2"><?php echo utf8_encode($clienteSeleiconado)?></font>
                </p>
            </td>
            <td style="width:350px;">
                <font size="2">
                    <?php echo utf8_encode("Realizar o recebimento do pedido de compra  " . $nPedidoCompraL)?>
                </font>
            </td>


            <td style="width:200px;">
                <font size="2"> <?php echo real_format($valorTotal)?></font>
            </td>


            <?php
                }
             
            ?>
    </tbody>
</table>
