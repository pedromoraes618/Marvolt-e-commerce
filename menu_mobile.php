</label><i id="abrir_menu_mobile" class="fa-solid fa-bars"></i>
<nav class="nav-mobile" id="nav-mobile">
    <div class="titulo">
        <p>Categoria</p><i class="fa-solid fa-layer-group"></i>
        <button id="fechar_menu_mobile" type="button"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <ul>

        <?php
                        while($linha = mysqli_fetch_assoc($resultado_categoria_mobile)){
                            $b_categoria = ($linha['cl_descricao']);
                            $b_id = $linha['cl_id'];
                            ?>
        <li>
            <div class="linha">
                <a href="?categoria=<?php echo $b_id ?>"><?php echo ucfirst($b_categoria); ?></a> <i
                    class="fa-solid fa-angle-up" id="seta-right"></i>
            </div>

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
                    <div class="linha">
                        <a href="?subcategoria=<?php echo $b_id ?>"><?php echo $b_descricao;  ?></a>
                    </div>
                </li>

                <?php }?>
            </ul>
        </li>
        <?php };?>
    </ul>
</nav>