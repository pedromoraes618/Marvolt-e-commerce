<!-- Entrega de produtos -->
<nav id="cabecalho">
    <ul>

        <li>
            Lembrete para entrega de produtos <i style=" font-size:18px" class="fa-solid fa-car-rear"></i>
        </li>
    </ul>
</nav>
<table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
    <tbody>

        <tr id="cabecalho_pesquisa_consulta">

            <td>
                <p>Entrega Prevista</p>
            </td>

            <td>
                <p>Empresa</p>
            </td>
            <td>
                <p>Descrição</p>
            </td>


        </tr>

        <?php

    while($linha = mysqli_fetch_assoc($lista_pesquisa_entrega)){
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
                    <font size="2"> <?php if($entregaPrevista=="0000-00-00") {
                               echo ("");

                                  }elseif($entregaPrevista=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($entregaPrevista); } ?></font>
                </p>
            </td>

            <td style="width:300px;">
                <p>
                    <font size="2"><?php echo utf8_encode($clienteSeleiconado)?></font>
                </p>
            </td>
            <td style="width:350px;">
                <font size="2">
                    <?php echo utf8_encode("Realizar a entrega do pedido " . $nPedidoCompraL)?>
                </font>
            </td>


            <?php
                }
             
            ?>
    </tbody>
</table>