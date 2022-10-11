<nav id="cabecalho">
    <ul>
        <?php if(isset($_GET['pCliente'])){?>
        <li>
            Faturamento Por cliente
        </li>
        <?php }
                ?>
    </ul>
</nav>

<table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
    <tbody>

        <tr id="cabecalho_pesquisa_consulta">
            <?php
                       
                          
                        ?>
            <td>
                <p>Ranking</p>
            </td>
            <td>
                <p>Empresa</p>
            </td>
            <td>
                <p>Valor</p>
            </td>


        </tr>

        <?php
                    $linhas = 0;
                    while($linha_pesquisa = mysqli_fetch_assoc($lista_pesquisa)){
                    $dataPagamento = $linha_pesquisa["data_do_pagamento"];
                    $dataVencimentoL = $linha_pesquisa["data_a_pagar"];
                    $clienteL = $linha_pesquisa['nome_fantasia'];
                    $descricao = $linha_pesquisa['descricao'];
                    $statusL = $linha_pesquisa["status"];
                    $subGrupo = ($linha_pesquisa["subgrupo"]);
                    $grupo = utf8_encode($linha_pesquisa["grupo"]);
                    $valorL = $linha_pesquisa["somaI"];
                    $documentoL = $linha_pesquisa["documento"];
                    $receite_despesa = $linha_pesquisa["receita_despesa"];
                    $lancamentoID = $linha_pesquisa["lancamentoFinanceiroID"];
               
                   
                    ?>

        <tr id="linha_pesquisa">



            <td style="width: 70px; ">
                <p style="margin-left: 15px; margin-top:10px;">
                    <font size="3"><?php echo $linhas = $linhas +1;?></font>
                </p>
            </td>

            <td style="width:200px;">

                <p>
                    <font size="2"><?php echo utf8_encode($clienteL)?></font>
                </p>
            </td>

            <td style="width:200px;">

                <p>
                    <font size="2"><?php echo real_format($valorL)?></font>
                </p>
            </td>
        </tr>


        <?php
                    }

                    while($linha_Soma_Valor = mysqli_fetch_assoc($lista_Soma_Valor)){
                
                        ?>

        <tr id="cabecalho_pesquisa_consulta">

            <td>
                <p>Valor</p>
            </td>

            <td>
                <p></p>
            </td>


            <td style="width: 80px;">
                <p><?php echo real_format($linha_Soma_Valor['soma']) ?></p>
            </td>


        </tr>

        <?php
                             
                        
                    }
             
            
            ?>
    </tbody>
</table>