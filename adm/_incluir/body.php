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
                        <li><a href="../../../marvoltect/adm/cdfabricante/consulta_fabricante.php">Fabricante</a></li>
                        <li><a href="../../../marvoltect/adm/cdembalagem/consulta_embalagem.php">Embalagem</a></li>


                    </ul>
                </li>
             
               
                <li><a>Menu<i class="fa-solid fa-arrow-down"></i></a>
                    <ul>
                        <li><a href="../../../marvoltect/adm/cdcategoria/consulta_categoria.php">Categoria</a></li>
                        <li><a href="../../../marvoltect/adm/cdsubcategoria/consulta_subcategoria.php">Subcategoria</a></li>

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