<nav id="cabecalho">
    <ul>

        <li>
        Cx - Resumo
        </li>

    </ul>
</nav>

<table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
    <tbody>

        <tr id="cabecalho_pesquisa_consulta">

            <td>
                <p>Receita (+)</p>
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
                <p><?php echo real_format($somaReceita); ?></p>
            </td>

        </tr>
        <tr id="cabecalho_pesquisa_consulta">

            <td>
                <p>Despessa (-)</p>
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
                <p><?php echo real_format($somaDespesa); ?></p>
            </td>

        </tr>

        <tr id="cabecalho_pesquisa_consulta">

            <td>
                <p>Total</p>
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
                <p><?php echo real_format($somaReceita-$somaDespesa); ?></p>
            </td>

        </tr>

        <?php
                             
                        
                    
        
            ?>
    </tbody>
</table>