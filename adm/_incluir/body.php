<?php 


?>


<head>
    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>

</head>

<body>
    <div id="menulateral">
        <input type="checkbox" id="chec">

        <label for="chec">
            <img src="https://img.icons8.com/windows/32/000000/menu--v4.png" />

        </label>

        <nav>
            <ul>
                <li><a href="../../../marvoltect/adm/index.php">Home</a></li>

                <li> <a
                        onclick="window.open('../../../marvolt/lembrete/lembrete.php', 
        'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">Lembrete

                    </a>
                </li>

        

                <li><a>Cliente<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        <li><a href="../../../marvoltect/cdcliente/consulta_cliente.php">Cadastro de Cliente</a></li>
                    </ul>
                </li>
              
             
                <li><a>Produto<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        <li><a href="../../../marvoltect/adm/cdproduto/consulta_produto.php">Produto</a></li>

                    </ul>
                </li>
             
               
                <li><a>Cotação<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        <li><a href="../../../marvoltect/cotacao/consulta_cotacao.php">Cotação</a></li>
                        <li><a href="../../../marvoltect/cotacao/relatorioEmpresa.php">Relatório / Empresa</a></li>

                    </ul>
                </li>
    

                <li><a>Pedido de compra<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        
                        <li><a href="../../../marvoltect/pdcompra/consulta_pdcompra.php">Pedido de Compra</a></li>
                   

                        <li><a href="../../../marvoltect/pdcompra/consulta_pdcompra_produtos.php">Check Produtos</a></li>
                    </ul>

                </li>
               
                <li><a>Nota fiscal<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        <li><a href="../../../marvoltect/nota_fiscal/consulta_nota_fiscal.php">NFE Entrada</a></li>
                        <li><a href="../../../marvoltect/nota_fiscal/consulta_nota_fiscal_saida.php">NFE Saida</a></li>

                    </ul>
                </li>
         

             
                <li><a>Financeiro<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        <li><a href="../../../marvoltect/adm/financeiro/consulta_financeiro.php">Lançar no Financeiro</a></li>
                        <li><a href="../../../marvoltect/financeiro/caixa.php">Caixa</a></li>
                        <li><a href="../../../marvoltect/financeiro/relatorio_apagar_receber.php">Relatórios Pagamentos e
                                Recebimentos</a></li>
                    </ul>
                </li>

            
                <li><a>Faturamento<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        <li><a href="../../../marvoltect/faturamento/relatorio_faturamento.php">Relatório / Faturamento</a>
                        </li>

                    </ul>
                </li>
             

                <li><a>Patrimônio<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        <li><a href="../../../marvoltect/patrimonio/consulta_patrimonio.php">Consultar</a>
                        </li>

                    </ul>
                </li>



                <li><a>Configuração<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                   
                        <li><a href="../../../marvoltect/configuracao/usuario/consulta_usuario.php">Usuário</a></li>
                        <li><a
                                href="../../../marvoltect/configuracao/empresa/registro_empresa.php?codEmpresa=<?php echo 1 ?>">Empresa</a>
                        </li>
                   
                        <li><a href="../../../marvoltect/configuracao/categoria/consultar_categoria.php">Categoria de
                                Produtos</a></li>
                        <li><a href="../../../marvoltect/configuracao/forma_pagamento/consultar_forma_pagamento.php">Forma
                                de Pagamento</a></li>
                        <li><a
                                href="../../../marvoltect/configuracao/sub_grupo_despesa_receita/consultar_subgrupo.php">SubGrupo</a>
                        </li>
                       
                        <li><a href="../../../marvoltect/configuracao/parametros/consultar_parametro.php">Parâmetros</a>
                        </li>
                       
                    </ul>
                </li>
            

            </ul>
        </nav>
    </div>
</body>