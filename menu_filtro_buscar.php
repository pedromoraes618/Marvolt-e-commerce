<div class="menu_filtro">
    <div class="filtro">
        <button id="abrir_filtro" type="button"><i class="fa-solid fa-filter"></i>
            <p> Filtro</p>
        </button>
    </div>
    <nav>
        <div class="titulo">
            <p>Filtro</p> <i class="fa-solid fa-filter"></i><button id="fechar_filtro" type="button"><i
                    class="fa-solid fa-xmark"></i></button>
        </div>
        <ul>
            <p><?php echo titulo_subcategoria($b_id);   ?></p>

            <?php   while ($linha = mysqli_fetch_assoc($resultado_lista_categoria_filtro)) {
                 $b_categoria = ($linha['categoria']);
                 $b_id = utf8_encode($linha['id_categoria']);
                        ?>
            <li>
                <a href="?categoria=<?php echo $b_id; ?>&buscar=<?php echo $b_desc_p; ?>">
                    <p class="categoria"> <?php echo ($b_categoria); ?></p>
                </a>
                <div class="qtd">
                    <p><?php   echo qtd_categoria($b_id,$b_desc_p); ?></p>
                </div>
                </li>
                <hr>
                <ul>

                    <?php 
                        //query para listar as subcategorias quando é feita a pesquisa a vulsa de produtos // tela buscar
                        $select = "SELECT s.cl_descricao as subcategoria,p.cl_subcategoria as id_subcategoria 
                        from tb_produto as p inner join 
                        tb_subcategoria as s on s.cl_id = p.cl_subcategoria 
                        where p.cl_categoria = '$b_id' and cl_titulo LIKE '%{$b_desc_p}%' 
                        GROUP BY subcategoria ";
                        $resultado_lista_subcategoria = mysqli_query($conecta, $select);
                        if(!$resultado_lista_subcategoria){
                        die("Falha na consulta ao banco de dados ");
                        }
                        while ($linha = mysqli_fetch_assoc($resultado_lista_subcategoria)) {
                        $b_subcategoria = ($linha['subcategoria']);
                        $b_id = ($linha['id_subcategoria']);
                        ?>
                    <li>
                        <a href="?subcategoria=<?php echo $b_id; ?>&buscar=<?php echo $b_desc_p; ?>">
                            <p class="bloco-1-1-s"> <?php echo ($b_subcategoria); ?></p>
                        </a>

                        <div class="qtd">
                            <p><?php      echo qtd_subcategoria_2($b_id,$b_desc_p);?></p>
                        </div>

                    </li>
                 
                    <?php  } ?>
                </ul>
       


            <?php }?>
        </ul>
    </nav>
</div>