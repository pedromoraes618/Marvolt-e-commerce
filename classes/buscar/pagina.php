<?php 

?>
<div class="row" id="bloco">
    <div class="tile-bloco">
        <p>Buscar por <?php 
        echo $b_desc_p; ?></p>
    </div>
    <div class="container">
        <div class="bloco-1">
            <table>
                <?php while ($linha = mysqli_fetch_assoc($resultado_lista_categoria)) {
                        $b_categoria = utf8_encode($linha['categoria']);
                        $b_id = utf8_encode($linha['id_categoria']);
                        ?>

                <tr>
                    <td>
                        
                        <a href="?categoria=<?php echo $b_id; ?>&buscar=<?php echo $b_desc_p; ?>">
                            <p> <?php echo ($b_categoria); ?></p>
                        </a>
                    </td>
                    <td style="width:20px">
                        <p>
                            <?php 
                   echo qtd_categoria($b_id,$b_desc_p);
                ?></p>
                    </td>

                </tr>




                <?php
                //query para listar as subcategorias quando é feita a pesquisa a vulsa de produtos // tela buscar
                $select = "SELECT s.cl_descricao as subcategoria,p.cl_subcategoria as id_subcategoria from tb_produto as p inner join tb_subcategoria as s on s.cl_id = p.cl_subcategoria  where p.cl_categoria = '$b_id' and cl_titulo LIKE '%{$b_desc_p}%'  GROUP BY subcategoria ";
                $resultado_lista_subcategoria = mysqli_query($conecta, $select);
                if(!$resultado_lista_subcategoria){
                die("Falha na consulta ao banco de dados ");
                }
                while ($linha = mysqli_fetch_assoc($resultado_lista_subcategoria)) {
                                $b_subcategoria = utf8_encode($linha['subcategoria']);
                                $b_id = utf8_encode($linha['id_subcategoria']);
                                ?>
                <tr>
                    <td>

                        <a href="?subcategoria=<?php echo $b_id; ?>&buscar=<?php echo $b_desc_p; ?>">
                            <p class="bloco-1-1-s"> <?php echo ($b_subcategoria); ?></p>
                        </a>
                    </td>
                    <td>
                        <p>
                            <?php 
                                echo qtd_subcategoria_2($b_id,$b_desc_p);
                                ?></p>
                    </td>

                </tr>




                <?php  } ?>
                <th class="linha-categoria"></th>

                <?php } ?>

            </table>

        </div>



        <div class="bloco-2">
            <div class="about-card">

                <?php 
                if (mysqli_num_rows($resultado_busca)==0)
                {
                   ?>

                <?php
              include "/../mensagem/msg_nenhum_produto.php";
                } else {
              
						while($linha = mysqli_fetch_assoc($resultado_buscas)){
                            $b_id = ($linha["cl_id"]);
                            $b_imagem = ($linha["cl_imagem"]);
                            $b_titulo = ($linha["cl_titulo"]);
                            $b_fabricante = ($linha["fabricante"]);
                            $b_embalagem = ($linha["embalagem"]);
                            $b_codigo = ($linha["cl_codigo"]);
                            $b_subcategoria = ($linha["cl_subcategoria"]);
						?>

                <?php 
            include "/../card/card.php";    
            } 
                }?>
            </div>

            <?php
            $pagina_anterior = $pagina -1;
            $pagina_posterior  = $pagina + 1;
            ?>
            <nav class="text-center" aria-label="Navegação de página exemplo">
                <ul class="pagination">
                    <li class="page-item">
                        <?php
                        if($pagina_anterior!=0){
                        ?>
                        <a class="page-link"
                            href="?pagina=<?php echo $pagina_anterior;?>&buscar=<?php echo $b_desc_p;?>"
                            aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <?php 
                    }else{
                        ?>
                        <span aria-hidden="true">&laquo;</span>

                        <?php
                    }
                    ?>
                    </li>
                    <?php
                    for($i = 1; $i < $num_pagina + 1; $i++){
                    ?>
                    <li class="page-item"><a class="page-link"
                            href="?pagina=<?php echo $i;?>&buscar=<?php echo $b_desc_p;?>"><?php echo $i; ?></a></li>
                    <?php 
                    }
                    ?>

                    <li class="page-item">

                        <?php
                        if($pagina_posterior <= $num_pagina){
                        ?>
                        <a class="page-link"
                            href="?pagina=<?php echo $pagina_posterior;?>&buscar=<?php echo $b_desc_p;?>"
                            aria-label="Anterior">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Próximo</span>
                        </a>
                        <?php 
                    }else{
                        ?>
                        <span aria-hidden="true">&raquo;</span>
                        <?php
                    }
                    ?>


                    </li>
                </ul>
            </nav>

        </div>

    </div>
</div>
<?php ?>