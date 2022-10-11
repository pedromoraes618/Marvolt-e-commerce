<nav id="cabecalho">
    <ul>

        <li>
        Cx - Despesa
        </li>

    </ul>
</nav>

<table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
    <tbody>

        <tr id="cabecalho_pesquisa_consulta">
            <?php
                       
                        ?>
            <td>
                <p>D.Pagamento</p>
            </td>
            <td>
                <p>Documento</p>
            </td>
            <td>
                <p>Empresa</p>
            </td>
            <td>
                <p>Forma Pgto</p>
            </td>
            <td>
                <p>Valor</p>
            </td>
        </tr>

        <?php
                    $linhas = 0;
                    while($linha_pesquisa = mysqli_fetch_assoc($lista_pesquisa_despsa)){
                    $dataPagamento = $linha_pesquisa["data_do_pagamento"];
                    $dataVencimentoL = $linha_pesquisa["data_a_pagar"];
                    $clienteL = $linha_pesquisa['nome_fantasia'];
                    $descricao = $linha_pesquisa['descricao'];
                    $valorReceita = $linha_pesquisa['valor'];
                    $subGrupo = ($linha_pesquisa["subgrupo"]);
                    $grupo = utf8_encode($linha_pesquisa["grupo"]);
                    $formaPagamento = utf8_encode($linha_pesquisa['nome']);
                    $documentoL = $linha_pesquisa["documento"];
                    $receite_despesa = $linha_pesquisa["receita_despesa"];
                    $lancamentoID = $linha_pesquisa["lancamentoFinanceiroID"];
               
                   
                    ?>

        <tr id="linha_pesquisa">



            <td style="width: 50px; ">
                <p style="margin-left: 5px; margin-top:10px;">
                    <font size="2"><?php echo formatardataB($dataPagamento);?></font>
                </p>
            </td>
            <td style="width:50px;">
                <p>
                    <font size="2"><?php echo utf8_encode($documentoL)?></font>
                </p>
            </td>
            <td style="width:200px;">

                <p>
                    <font size="2"><?php echo utf8_encode($clienteL)?></font>
                </p>
            </td>

            <td style="width:200px;">

                <p>
                    <font size="2"><?php echo utf8_encode($formaPagamento)?></font>
                </p>
            </td>
            <td style="width:100px;">

                <p>
                    <font size="2"><?php echo real_format($valorReceita)?></font>
                </p>
            </td>
        </tr>


        <?php
                    }

                
                        ?>

        <tr id="cabecalho_pesquisa_consulta">

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

            <td style="width: 80px;">
                <p><?php echo real_format($somaDespesa); ?></p>
            </td>


        </tr>

        <?php
                             
                        
                    
        
            ?>
    </tbody>
</table>