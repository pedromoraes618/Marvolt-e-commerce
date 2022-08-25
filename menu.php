<div class="top-1-3">
    <section class="top-1-1-3">
        <div class="col nav-menu">

            <ul>
                <?php
                        while($linha = mysqli_fetch_assoc($resultado_categoria)){
                            $b_categoria = ($linha['cl_descricao']);
                            $b_id = $linha['cl_id'];
                        
                            ?>

                <li><a href="?categoria=<?php echo $b_id ?>"><?php echo $b_categoria; ?></a>
                    <ul>
                        <?php
                                        $subcategoria = "SELECT * FROM tb_subcategoria where  cl_categoria = '$b_id' ";
                                        $resultado_subcategoria = mysqli_query($conecta, $subcategoria);
                                        if(!$resultado_subcategoria){
                                        die("Falha na consulta ao banco de dados || tb_subcategoria");
                                        }

                                        while($linha = mysqli_fetch_assoc($resultado_subcategoria)){
                                            $b_id= utf8_encode($linha['cl_id']);
                                        $b_descricao= ($linha['cl_descricao']);
                                        ?>
                        <li>
                            <a href="?subcategoria=<?php echo $b_id ?>"><?php echo $b_descricao;  ?></a>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <?php };?>
            </ul>
        </div>
    </section>
</div>