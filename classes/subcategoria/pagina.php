<div class="row" id="bloco">
    <nav class="text-left" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/marvoltect"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="?subcategoria=<?php echo $b_mapa_id_subcategoria ; ?>"><?php echo utf8_encode(ucfirst(strtolower($b_mapa_descricao_subcategoria))); ?></a>
            </li>
        </ol>
    </nav>
    <div class="tile-bloco">
        <p><?php
        echo titulo_subcategoria($b_id);  ?></p>
    </div>
    <p style="font-size:0.8em;margin-left:5px; font: weight 500px; color:darkgrey">Fabricantes</p>
    <div class="container">
        <div class="bloco-1">
            <table>
                <?php
                
                while ($linha = mysqli_fetch_assoc($resultado_produto_f)) {
                       $b_fabricante = utf8_encode($linha['inner_fabricante']);
                       $b_id_f = $linha['inner_id_fabricante'];
                        ?>
                <tr>
                    <td>
                        <a href="?fabricante=<?php echo $b_id_f; ?>">
                            <p> <?php echo $b_fabricante; ?></p>
                        </a>
                    </td>
                    <td style="width:20px">
                        <p>
                            <?php 
                 echo qtd_fabricante($b_id_f,$b_id);
                ?></p>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </div>


        <div class="bloco-2">
            <div class="about-card">

                <?php 
                if (mysqli_num_rows($resultado_produto_subcategoria)==0)
                {
                   ?>

                <?php
                 include "/../mensagem/msg_nenhum_produto.php";
                } else {
						while($linha = mysqli_fetch_assoc($resultado_produto_subcategoria)){
							$b_id = $linha["cl_id"];
							$b_imagem = ($linha["cl_imagem"]);
							$b_titulo = ($linha["cl_titulo"]);
							$b_descricao = ($linha["cl_descricao"]);
							$b_fabricante = ($linha["as_descricao_fabricante"]);
							$b_categoria = ($linha["as_descricao_categoria"]);
                            $b_subcategoria = ($linha["cl_subcategoria"]);
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