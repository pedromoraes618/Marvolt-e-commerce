<?php 
?>
<div class="row" id="bloco">
    <div class="tile-bloco">
        <p><?php 
    
        echo categoria($b_id); ?></p>
    </div>
    <div class="container">
        <div class="bloco-1">
            <table>
                <?php while ($linha = mysqli_fetch_assoc($resultado_subcategoria)) {
                        $b_subcategoria = utf8_encode($linha['cl_descricao']);
                        $b_id = $linha['cl_id'];
                        ?>
                <tr>
                    <td>
                        <p> <?php echo $b_subcategoria; ?></p>
                    </td>
                    <td style="width:20px">
                        <p>
                            <?php 
                    echo qtd_subcategoria($b_id);
                ?></p>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </div>


        <div class="bloco-2">
            <div class="about-card">

                <?php 
                if (mysqli_num_rows($resultado_produto_categoria)==0)
                {
                   ?>
                <div class="msg-alert">
                    <p>Nenhum produto encontrado</p>
                </div>
                <?php
                } else {
              
						while($linha = mysqli_fetch_assoc($resultado_produto_categoria)){
							$b_id = $linha["cl_id"];
							$b_imagem = ($linha["cl_imagem"]);
							$b_titulo = ($linha["cl_titulo"]);
							$b_descricao = ($linha["cl_descricao"]);
							$b_fabricante = ($linha["as_descricao_fabricante"]);
							$b_categoria = ($linha["as_descricao_categoria"]);
							$b_ativo = ($linha["cl_ativo"]);
							$destaque = ($linha["cl_destaque"]);
                            $b_embalagem = ($linha["embalagem"]);
                            $b_codigo = ($linha["cl_codigo"]);
						?>

                <?php 
            include "/../card/card.php";    
            } 
                }?>
            </div>
        </div>

    </div>
</div>
<?php ?>