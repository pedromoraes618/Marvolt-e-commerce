<table>

    <div id="titulo">
        </p>Cotação</p>
    </div>


    <tr>
        <td>Código:</td>
        <td align=left><input readonly type="text" size="10" name="codigoCotacao" value="<?php 
         if(isset($_POST)){
                echo $id_cotacao + 1 ;
         }
         ?>"> </td>


        <td align=left><input readonly type="hidden" size="10" name="cotacaofinalizada" placeholder="finalizado" value="<?php 
            //1 Para não poder incluir item e 0 para incluir iten
         
            if(isset($_POST['salvar'])){
                echo 1;
            }elseif(isset($_POST['iniciar'])){
                echo 0;
            }
            if(isset($_POST['adicionar'])){
                echo $_POST['cotacaofinalizada'];
            }

         
         ?>"> </td>
        <td align=left><input readonly type="hidden" size="10" name="tueSalvar" value="<?php
            if(isset($_POST['adicionar']))
            {
                if($salvar == ""){
                    echo 1;
                }else{
                    echo 1;
                }
            }
            
            ?>"> </td>

    </tr>


    <tr>

        <td align=left> <b>Nº solicitação:</b></td>
        <td align=left> <input type="text" name="campoNsolitacao" size="10" value="<?php if(isset($_POST['adicionar'])){
     
    }?>"> </td>

        <td align=left> <b>Nº orçamento:</b></td>
        <td align=left> <input type="text" name="campoNorcamento" size="10" value="<?php if(isset($_POST['adicionar'])){
     
    }?>"> </td>



        <td><b>Data recebida:</b></td>
        <td align="left"> <input type="text" name="campoDataRecebida" OnKeyUp="mascaraData(this);" size="10" onchange=""
                value="<?php if(isset($_POST['adicionar'])){

    }?>"></td>

        <td> <b>Data a responder:<b>
        <td> <input type="text" name="campoDataRecebida" OnKeyUp="mascaraData(this);" size="10" onchange="" value="<?php if(isset($_POST['adicionar'])){
            
    }?>"></td>

        <td> <b>Validade:<b>
        <td><input type="text" name="campoDataRecebida" size="10" value="<?php if(isset($_POST['adicionar'])){
   
    }?>"> </td>


    </tr>



    <tr>

        <td align=left> <b>Cliente:</b></td>
        <td align=left> <select style="width: 500px;" name="campoCliente" id="campoCliente">

                <?php  while($linha_cliente = mysqli_fetch_assoc($lista_clientes)){
                $cliente_Principal = utf8_encode($linha_cliente["clienteID"]);
               if(!isset($clienteID)){
               
               ?>
                <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>">
                    <?php echo utf8_encode($linha_cliente["razaosocial"]);?>
                </option>
                <?php
               
               }else{

                if($clienteID==$cliente_Principal){
                ?> <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>" selected>
                    <?php echo utf8_encode($linha_cliente["razaosocial"]);?>
                </option>

                <?php
                         }else{
                
               ?>
                <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>">
                    <?php echo utf8_encode($linha_cliente["razaosocial"]);?>
                </option>
                <?php

}

}

             
}

?> </td>
        <td align=left><b>Data envio:</b></td>
        <td align=left><input type="text" name="campoDataEnvio" OnKeyUp="mascaraData(this);" size="10" value="<?php if(isset($_POST['adicionar'])){
     
    }?>">

            <b>Data fechamento:</b>
            <input type="text" name="campoDaFechamento" OnKeyUp="mascaraData(this);" size="10" value="<?php if(isset($_POST['adicionar'])){
      
    }?>">

            <b>Dias neg</b>
            <input type="text" name="campoDiasNegociacao" OnKeyUp="mascaraData(this);" size="10" value="<?php if(isset($_POST['adicionar'])){
      
    }?>">


        </td>

        <td align=left><b>Comprador:</b></td>
        <td><select style="width: 200px;" name="campoComprador" id="campoComprador">

                <?php  while($linha_comprador = mysqli_fetch_assoc($lista_comprador)){
            $comprador_Principal = utf8_encode($linha_comprador["id_comprador"]);
            if(!isset($compradorID)){
            
            ?>
                <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>">
                    <?php echo utf8_encode($linha_comprador["comprador"]);?>
                </option>
                <?php

            }else{

            if($compradorID==$comprador_Principal){
            ?> <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>" selected>
                    <?php echo utf8_encode($linha_comprador["comprador"]);?>
                </option>

                <?php
               }else{

?>
                <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>">
                    <?php echo utf8_encode($linha_comprador["comprador"]);?>
                </option>
                <?php

}

}


}

?>
            </select>
        </td>

        <td align=left><b>Frete:</b></td>
        <td><select style="width: 250px; margin-right:30px; " name="campoFrete" id="campoFrete">

                <?php  while($linha_frete = mysqli_fetch_assoc($lista_frete)){
            $frete_principal= utf8_encode($linha_frete["freteID"]);
            if(!isset($freteID)){
            
            ?>
                <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>">
                    <?php echo utf8_encode($linha_frete["descricao"]);?>
                </option>
                <?php

            }else{

            if($freteID==$frete_principal){
            ?> <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>" selected>
                    <?php echo utf8_encode($linha_frete["descricao"]);?>
                </option>

                <?php
               }else{

?>
                <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>">
                    <?php echo utf8_encode($linha_frete["descricao"]);?>
                </option>
                <?php

        }

   }


}

?>
            </select>
        </td>
        <td align=left> <b>Forma do pagamento:</b></td>
        <td align=left><select style="width: 150px;" id="campoFormaPagamento" name="campoFormaPagamento">
            <?php 
            while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
               if(!isset($formaPagamento)){
               
               ?>
            <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
            </option>
            <?php
               
               }else{

                if($formaPagamento==$formaPagamentoPrincipal){
                ?> <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>" selected>
                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
            </option>

            <?php
                         }else{
                
               ?>
            <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
            </option>
            <?php

}

}

             
}

         ?>

        </select>
        </td>
    </tr>


    <tr>
        <td align=left><b>produto:</b></td>
        <td align=left><input type="text" size=60 name="campoNomeProduto" value="">
        </td>


        <td><b>Status Proposta:</b></td>
        <td><select style="width:170px; margin-right:20px; " name="campoStatusProposta" id="campoStatusProposta">

                <?php  while($linha_status_proposta= mysqli_fetch_assoc($lista_situacao_proposta)){
            $statusProposta_principal= utf8_encode($linha_status_proposta["statusID"]);
            if(!isset($statusProposta)){
            
            ?>
                <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>">
                    <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                </option>
                <?php

            }else{

            if($statusProposta==$statusProposta_principal){
            ?> <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>" selected>
                    <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                </option>

                <?php
               }else{

?>
                <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>">
                    <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                </option>
                <?php

        }

   }


}

?>
            </select>

            <b>Prazo entrega:</b>
            <input type="text" name="campoPrazoEntrega" OnKeyUp="mascaraData(this);" size="10" value="<?php if(isset($_POST['adicionar'])){
      
         }?>">


        </td>



    </tr>
    <td>

    </td>
</table>

<table id="divisaoTabela">
    <td>
        <div id="divDivisao">
        </div>
    </td>

</table>

<table style="margin-left:0px;">

    <tr>
        <div>
            <td align=left><b>Qtd:</b></td>
            <td align=left><input type="text" size=20 name="campoNomeProduto" value="">
            </td>
            <td align=left><b>Preço cotao:</b></td>
            <td align=left><input type="text" size=20 name="campoNomeProduto" value="">
            </td>
            <td align=left><b>Preço venda:</b></td>
            <td align=left><input type="text" size=20 name="campoNomeProduto" value="">
            </td>
            <td align=left><b>margem:</b></td>
            <td align=left><input type="text" size=20 name="campoNomeProduto" value="">
            </td>

        </div>
    </tr>


</table>




</form>




<form action="consulta_produto.php" method="get">

    <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
        <tbody>
            <tr id="cabecalho_pesquisa_consulta">
                <td>
                    <p>Código</p>
                </td>

                <td>
                    <p>Descrição</p>
                </td>
                <td>
                    <p>Preço venda</p>
                </td>
                <td>
                    <p>Preço compra</p>
                </td>
                <td>
                    <p>Estoque</p>
                </td>


                <td>
                    <p>Categoria</p>
                </td>
                <td>
                    <p>Ativo</p>
                </td>
                <td>
                    <p>UND</p>
                </td>

                <td>
                    <p></p>
                </td>

            </tr>

            <?php
if(isset($_POST['adicionar'])){

if($cotacaofinalizada==0 && $cotacaofinalizada  != ""){

while($linha = mysqli_fetch_assoc($lista_Produto_otacao)){
?>
            <tr id="linha_pesquisa">

                <td style="width: 70px;">
                    <font size="3"><?php echo $linha['cotacaoID']?></font>
                </td>

                <td style="width: 500px;">
                    <p>
                        <font size="2"><?php echo $linha['descricao']?> </font>
                    </p>
                </td>
                <td style="width: 150px;">
                    <font size="2"></font>
                </td>
                <td style="width: 150px;">
                    <font size="2"> </font>
                </td>

                <td style="width: 100px;">
                    <font size="2"> </font>
                </td>

                <td style="width: 130px;">
                    <font size="2"> </font>
                </td>

                <td style="width: 90px;">
                    <font size="2"> </font>
                </td>
                <td>
                    <font size="2"> </font>
                </td>

                <td id="botaoEditar">


                    <a
                        onclick="window.open('editar_cotacao.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                        <button type="button" name="editar">Editar</button>
                    </a>

                </td>


            </tr>



            <?php
}
}
}
?>
        </tbody>
    </table>