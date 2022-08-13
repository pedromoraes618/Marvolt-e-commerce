<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");
include ("../_incluir/funcoes.php");

//consultar cotacao

if(isset($_GET["pesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"])  {

    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];
 

    if($pesquisaData==""){
          
    }else{
        $div1 = explode("/",$_GET['CampoPesquisaData']);
        $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
       
    }
    if($pesquisaDataf==""){
       
    }else{
    $div2 = explode("/",$_GET['CampoPesquisaDataf']);
    $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
    }

    
    $select = " SELECT cotacao.numero_orcamento,cotacao.cotacaoID,cotacao.data_lancamento, cotacao.status_proposta,cotacao.dias_negociacao, 
    count(cotacao.status_proposta) as qtdGanha, min(valorTotalComDesconto) as somaMin, sum(valorTotalComDesconto) as totalVlrCotacao, cotacao.compradorID, 
    cotacao.desconto,cotacao.valorTotalComDesconto, cotacao.cod_cotacao, clientes.clienteID, clientes.nome_fantasia as cliente,situacao_proposta.descricao as situacao,
     cotacao.validade,cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID " ;
    $select .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf'  and status_proposta = '3'  group by cliente order by  qtdGanha desc";
    $resultado = mysqli_query($conecta, $select);
    if(!$resultado){
        die("Falha na consulta ao banco de dados");
        
    }

    $selectParcial = " SELECT cotacao.numero_orcamento,cotacao.cotacaoID,cotacao.data_lancamento, cotacao.status_proposta,cotacao.dias_negociacao, 
    count(cotacao.status_proposta) as qtdGanhaParcial, min(valorTotalComDesconto) as somaMin, sum(valorTotalComDesconto) as totalVlrCotacao, 
    cotacao.compradorID, cotacao.desconto,cotacao.valorTotalComDesconto, cotacao.cod_cotacao, clientes.clienteID, clientes.nome_fantasia as cliente,
    situacao_proposta.descricao as situacao, cotacao.validade,cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join 
    cotacao on cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID " ;
    $selectParcial .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf'  and status_proposta = '4'  group by cliente order by  somaMin";
    $resultadoParcial = mysqli_query($conecta, $selectParcial);
    if(!$resultadoParcial){
        die("Falha na consulta ao banco de dados Parcial");
        
    }
    $selectPedidas = " SELECT cotacao.numero_orcamento,cotacao.cotacaoID,cotacao.data_lancamento, cotacao.status_proposta,cotacao.dias_negociacao,
     count(cotacao.status_proposta) as qtdPerdidas, min(valorTotalComDesconto) as somaMin, sum(valorTotalComDesconto) as totalVlrCotacao, cotacao.compradorID,
     cotacao.desconto,cotacao.valorTotalComDesconto, cotacao.cod_cotacao, clientes.clienteID, clientes.nome_fantasia as cliente,situacao_proposta.descricao as 
     situacao, cotacao.validade,cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on 
     cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID " ;
    $selectPedidas .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf'  and status_proposta = '5'  group by cliente order by  somaMin";
    $resultadoPerdidas = mysqli_query($conecta, $selectPedidas);
    if(!$resultadoPerdidas){
        die("Falha na consulta ao banco de dados Perdida");
        
    }
      
    //quantidades de cotação
    $selectResumoTotalCotacao = " SELECT count(status_proposta) as qtdCotacao from cotacao " ;
    $selectResumoTotalCotacao .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' ";
    $resultadoResumo = mysqli_query($conecta, $selectResumoTotalCotacao);
    if(!$resultadoResumo){
        die("Falha na consulta ao banco de dados");
        
    }else{
        $linha = mysqli_fetch_assoc($resultadoResumo);
        $qtdCotacao = $linha['qtdCotacao']; 
       }

       $selectEmpresaMaisCoutou = " SELECT count(status_proposta) as qtdEmpresa, clientes.nome_fantasia as cliente from clientes 
       inner join cotacao on cotacao.clienteID = clientes.clienteID " ;
       $selectEmpresaMaisCoutou .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' group by cliente order by qtdEmpresa desc ";
       $resultadoEmpresaMaisCoutou = mysqli_query($conecta, $selectEmpresaMaisCoutou);
       if(!$resultadoEmpresaMaisCoutou){
        die("Falha na consulta ao banco de dados");
        
          }else{
        $linha = mysqli_fetch_assoc($resultadoEmpresaMaisCoutou);
        $qtdEmpresa = utf8_encode($linha['cliente']); 
       }
}


if(isset($_GET["pesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"])   {

        $pesquisaData = $_GET["CampoPesquisaData"];
        $pesquisaDataf = $_GET["CampoPesquisaDataf"];
     
    
        if($pesquisaData==""){
              
        }else{
            $div1 = explode("/",$_GET['CampoPesquisaData']);
            $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
           
        }
        if($pesquisaDataf==""){
           
        }else{
        $div2 = explode("/",$_GET['CampoPesquisaDataf']);
        $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
        }
    
        
        $selectSoma = " SELECT cotacao.numero_orcamento,cotacao.cotacaoID,cotacao.data_lancamento, sum(valorTotalComDesconto) as soma, 
        count(cotacao.status_proposta) as qtdGanha, cotacao.status_proposta, cotacao.compradorID, cotacao.desconto,cotacao.valorTotalComDesconto, 
        cotacao.cod_cotacao, clientes.clienteID, clientes.nome_fantasia as cliente,situacao_proposta.descricao as situacao, cotacao.validade,
        cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on 
        cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID " ;
        $selectSoma .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and status_proposta = '3'  ";
        $lista_Soma_Valor = mysqli_query($conecta, $selectSoma);
        if(!$lista_Soma_Valor){
            die("Falha na consulta ao banco de dados");
            
        }else{
            $linha_Soma_Valor = mysqli_fetch_assoc($lista_Soma_Valor);
                $soma = $linha_Soma_Valor['soma'];
                $qtdGanhas = $linha_Soma_Valor['qtdGanha'];
        }

        $selectSomaParcial = " SELECT cotacao.numero_orcamento,cotacao.cotacaoID,cotacao.data_lancamento, sum(valorTotalComDesconto) as 
        soma, count(cotacao.status_proposta) as qtdGanhaParcial, cotacao.status_proposta, cotacao.compradorID, cotacao.desconto,cotacao.valorTotalComDesconto, 
        cotacao.cod_cotacao, clientes.clienteID, clientes.nome_fantasia as cliente,situacao_proposta.descricao as situacao, cotacao.validade,cotacao.data_responder,
        cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on 
        cotacao.status_proposta = situacao_proposta.statusID " ;
        $selectSomaParcial .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and status_proposta = '4'  ";
        $lista_Soma_Valor_Parcial = mysqli_query($conecta, $selectSomaParcial);
        if(!$lista_Soma_Valor_Parcial){
            die("Falha na consulta ao banco de dados Parcial");
            
        }else{
            $linha_Soma_Valor_pacial = mysqli_fetch_assoc($lista_Soma_Valor_Parcial);
                $somaParcial = $linha_Soma_Valor_pacial['soma'];
                $qtdGanhasParcial = $linha_Soma_Valor_pacial['qtdGanhaParcial'];
        }
        $selectSomaPerdidas = " SELECT cotacao.numero_orcamento,cotacao.cotacaoID,cotacao.data_lancamento, sum(valorTotalComDesconto) as soma, 
        count(cotacao.status_proposta) as qtdPerdidas, cotacao.status_proposta, cotacao.compradorID, cotacao.desconto,cotacao.valorTotalComDesconto, 
        cotacao.cod_cotacao, clientes.clienteID, clientes.nome_fantasia as cliente,situacao_proposta.descricao as situacao, 
        cotacao.validade,cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on 
        cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID " ;
        $selectSomaPerdidas .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and status_proposta = '5'  ";
        $lista_Soma_Valor_perdidas = mysqli_query($conecta, $selectSomaPerdidas);
        if(!$lista_Soma_Valor_perdidas){
            die("Falha na consulta ao banco de dados Perdida");
            
        }else{
                $linha_Soma_Valor_Perdidas = mysqli_fetch_assoc($lista_Soma_Valor_perdidas);
                    $somaPerdida = $linha_Soma_Valor_Perdidas['soma'];
                    $qtdPerdidas = $linha_Soma_Valor_Perdidas['qtdPerdidas'];
       
        }

        $selectSomaAberta = " SELECT cotacao.numero_orcamento,cotacao.cotacaoID,cotacao.data_lancamento, sum(valorTotalComDesconto) as soma, 
        count(cotacao.status_proposta) as qtdAberta, cotacao.status_proposta, cotacao.compradorID, cotacao.desconto,cotacao.valorTotalComDesconto, 
        cotacao.cod_cotacao, clientes.clienteID, clientes.nome_fantasia as cliente,situacao_proposta.descricao as situacao, 
        cotacao.validade,cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on 
        cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID " ;
        $selectSomaAberta .= " WHERE data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf' and status_proposta = '2'  ";
        $lista_Soma_Valor_Aberta = mysqli_query($conecta, $selectSomaAberta);
        if(!$lista_Soma_Valor_Aberta){
            die("Falha na consulta ao banco de dados Perdida");
            
        }else{
                $linha_Soma_Valor_Aberta = mysqli_fetch_assoc($lista_Soma_Valor_Aberta);
                    $somaAberta= $linha_Soma_Valor_Aberta['soma'];
                    $qtdAberta = $linha_Soma_Valor_Aberta['qtdAberta'];
       
        }


       
    }
    
    
        if (isset($_GET["CampoPesquisaData"])){
        $pesquisaData=$_GET["CampoPesquisaData"];
        }
        if (isset($_GET["CampoPesquisaDataf"])){
        $pesquisaDataf=$_GET["CampoPesquisaDataf"];
         }
    

  

?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/estilo.css" rel="stylesheet">
    <link href="../_css/pesquisa_tela.css" rel="stylesheet">

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>

    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>


        <div id="janela_pesquisa">
            <ul>
                <li>
                    <b> Data Referência</b>
                </li>

            </ul>


            <form action="" style="width:100%;" method="get">

                <input type="submit" style="width:150px; margin-right:50px" name="pesquisa" value="Relatório">

                <input style="width: 100px; " type="text" id="CampoPesquisaData" name="CampoPesquisaData"
                    placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if( !isset($_GET["CampoPesquisaData"])){ echo formatardataB(date('Y-m-01')); }
                              if (isset($_GET["CampoPesquisaData"])){
                                 echo $pesquisaData;
                     }?>">

                <input style=" width: 100px;" type="text" name="CampoPesquisaDataf" placeholder="Data final"
                    onkeyup="mascaraData(this);" value="<?php if(!isset($_GET["CampoPesquisaDataf"])){ echo date('d/m/Y');
                    } if (isset($_GET["CampoPesquisaDataf"])){ echo $pesquisaDataf;} ?>">


            </form>

        </div>

        <form action="" method="get">

            <table border="0" cellspacing="0" class="tabela_pesquisa">
                <tbody>
                    <nav id="titulos_relatorio">
                        <ul>
                            <li>
                                <p>Cotação Ganhas</p>
                            </li>
                        </ul>

                    </nav>


                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Ranking</p>
                        </td>
                        <td>
                            <p>Empresa</p>
                        </td>
                        <td>
                            <p>Cotações ganhas</p>
                        </td>
                        <td>
                            <p>Total</p>
                        </td>
                        <td>
                            <p>Produtos Fechados</p>
                        </td>
                        <td>
                            <p>Perda</p>
                        </td>




                    </tr>


                    <?php  
        if(isset($_GET["CampoPesquisaData"])){
            $linhas = 0;
           while($linha = mysqli_fetch_assoc($resultado)){
                
            $cotacaoID = $linha["cotacaoID"];
            $codCotacao = $linha["cod_cotacao"];
            $nOrcamento = $linha["numero_orcamento"];
            $cliente = $linha["cliente"];
            $clienteID = $linha["clienteID"];
            $situacao = $linha["situacao"];
            $status = $linha["status_proposta"];
            $validade = $linha["validade"];
            $data = $linha["data_lancamento"];
            $dataResponder = $linha["data_responder"];
            $DataEnvio = $linha["data_envio"];
            $DataFechamento = $linha["data_fechamento"];
            $desconto = $linha['desconto'];
            $valor = $linha['valorTotalComDesconto'];
            $comprador = $linha['compradorID'];
            $negociacao = $linha['dias_negociacao'];
            $qtdCotacaoGanho = $linha['qtdGanha'];
            $vlrTotalCotacao = $linha['totalVlrCotacao'];
            
            $pesquisaData = $_GET["CampoPesquisaData"];
            $pesquisaDataf = $_GET["CampoPesquisaDataf"];
         
        
            if($pesquisaData==""){
                  
            }else{
                $div1 = explode("/",$_GET['CampoPesquisaData']);
                $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
               
            }
            if($pesquisaDataf==""){
               
            }else{
            $div2 = explode("/",$_GET['CampoPesquisaDataf']);
            $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
            }
        
           ?>

                    <tr id="linha_pesquisa">

                        <td style="width: 100px;">
                            <p">
                                <font size="3" style="margin-left:20px"> <?php echo ($linhas = $linhas + 1) , " º"?>
                                </font>
                                </p>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($cliente);?> </font>
                            </p>
                        </td>

                        <td style="width:200px;">
                            <font size="2" style="margin-left:50px"><?php echo ($qtdCotacaoGanho);?></font>
                        </td>

                        <td style="width:200px;">
                            <font size="2"><?php echo real_format($vlrTotalCotacao);?></font>
                        </td>
                        <td style="width:200px;">
                            <?php 
                             $selectProdutoCotacaoTotal =  "SELECT sum(preco_venda*quantidade) as soma, cotacao.clienteID,cotacao.data_lancamento  from produto_cotacao inner join cotacao on produto_cotacao.cotacaoID = cotacao.cod_cotacao  where  cotacao.data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf'   and cotacao.status_proposta = 3 and cotacao.clienteID = '{$clienteID}' and produto_cotacao.status = 2 " ;
                             $lista_Produto_cotacao_total= mysqli_query($conecta, $selectProdutoCotacaoTotal);
                             if(!$lista_Produto_cotacao_total){
                             die("Falha no banco de dados || pesquisar produto cotacao");
                             }else{$linha_soma = mysqli_fetch_assoc($lista_Produto_cotacao_total);
                                 $somaTotal = $linha_soma['soma'];
                                
                             }
                             
                            
                            ?>
                            <font size="2" style="color:green;"><?php echo real_format($somaTotal);?></font>
                        </td>

                        <td>
                            <font size="2" style="color:green;"><?php 
                            $margem = ((1-($somaTotal/$vlrTotalCotacao))*100);
                            echo real_percent($margem);
                            
                            ?></font>
                        </td>

                    </tr>
                    <?php

                    }

    
                    ?>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Total</p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                        <td style="width: 140px;">
                            <p style="margin-left:50px;"><?php echo ($qtdGanhas); ?></p>
                        </td>

                        <td>
                            <p><?php echo real_format($soma); ?></p>
                        </td>

                        <td>

                        </td>
                        <td>
                            <p></p>
                        </td>



                    </tr>

                    <?php

                  
                  
             }
      
        
        ?>

                </tbody>
            </table>
            <table border="0" cellspacing="0" class="tabela_pesquisa">
                <tbody>
                    <nav id="titulos_relatorio">
                        <ul>
                            <li>
                                <p>Cotação Ganha parcial</p>
                            </li>
                        </ul>

                    </nav>


                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Posição</p>
                        </td>
                        <td>
                            <p>Empresa</p>
                        </td>
                        <td>
                            <p>Cotações Parciais</p>
                        </td>
                        <td>
                            <p>Total</p>
                        </td>
                        <td>
                            <p>Produtos Fechados</p>
                        </td>
                        <td>
                            <p>Perda</p>
                        </td>


                    </tr>


                    <?php  
        if(isset($_GET["CampoPesquisaData"])){
            $linhas = 0;
           while($linha = mysqli_fetch_assoc($resultadoParcial)){
                
            $cotacaoID = $linha["cotacaoID"];
            $codCotacao = $linha["cod_cotacao"];
            $nOrcamento = $linha["numero_orcamento"];
            $cliente = $linha["cliente"];
            $clienteID = $linha["clienteID"];
            $situacao = $linha["situacao"];
            $status = $linha["status_proposta"];
            $validade = $linha["validade"];
            $data = $linha["data_lancamento"];
            $dataResponder = $linha["data_responder"];
            $DataEnvio = $linha["data_envio"];
            $DataFechamento = $linha["data_fechamento"];
            $desconto = $linha['desconto'];
            $valor = $linha['valorTotalComDesconto'];
            $comprador = $linha['compradorID'];
            $negociacao = $linha['dias_negociacao'];
            $qtdCotacaoParcial = $linha['qtdGanhaParcial'];
            $vlrTotalCotacao = $linha['totalVlrCotacao'];
            
            
          
            
          
         

         
           ?>

                    <tr id="linha_pesquisa">

                        <td style="width: 100px;">
                            <p">
                                <font size="3" style="margin-left:20px"> <?php echo ($linhas = $linhas + 1) , " º"?>
                                </font>
                                </p>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($cliente);?> </font>
                            </p>
                        </td>

                        <td style="width:200px;">
                            <font size="2" style="margin-left:50px"><?php echo ($qtdCotacaoParcial);?></font>
                        </td>

                        <td style="width:200px;">
                            <font size="2"><?php echo real_format($vlrTotalCotacao);?></font>
                        </td>
                        <td style="width:200px;">
                            <?php 
                            $selectProdutoCotacaoTotal =  "SELECT sum(preco_venda*quantidade) as soma, cotacao.clienteID,cotacao.data_lancamento  from produto_cotacao inner join cotacao on produto_cotacao.cotacaoID = cotacao.cod_cotacao  where  cotacao.data_lancamento BETWEEN '$pesquisaData' and '$pesquisaDataf'   and cotacao.status_proposta = 4 and cotacao.clienteID = '{$clienteID}' and produto_cotacao.status = 2 " ;
                             $lista_Produto_cotacao_total= mysqli_query($conecta, $selectProdutoCotacaoTotal);
                             if(!$lista_Produto_cotacao_total){
                             die("Falha no banco de dados || pesquisar produto cotacao");
                             }else{$linha_soma = mysqli_fetch_assoc($lista_Produto_cotacao_total);
                                 $somaTotal = $linha_soma['soma'];
                                
                             }
                             
                            
                            ?>
                            <font size="2" style="color:green;"><?php echo real_format($somaTotal);?></font>
                        </td>

                        <td>
                            <font size="2" style="color:green;"><?php 
                            $margem = ((1-($somaTotal/$vlrTotalCotacao))*100);
                            echo real_percent($margem);
                            
                            ?></font>
                        </td>


                    </tr>
                    <?php

                    }

                   
           
         
 
                    ?>

                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Total</p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                        <td style="width: 140px;">
                            <p style="margin-left:50px;"><?php echo ($qtdGanhasParcial); ?></p>
                        </td>

                        <td>
                            <p><?php echo real_format($somaParcial); ?></p>
                        </td>

                        <td>

                        </td>
                        <td>
                            <p></p>
                        </td>



                    </tr>

                    <?php

                  
                  
             }
      
        
        ?>

                </tbody>
            </table>
            <table border="0" cellspacing="0" class="tabela_pesquisa">

                <tbody>
                    <nav id="titulos_relatorio">
                        <ul>
                            <li>
                                <p>Cotações Perdidas</p>
                            </li>
                        </ul>

                    </nav>


                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Posição</p>
                        </td>
                        <td>
                            <p>Empresa</p>
                        </td>
                        <td>
                            <p>Cotações Perdidas</p>
                        </td>
                        <td>
                            <p>Total</p>
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>




                    </tr>


                    <?php  
        if(isset($_GET["CampoPesquisaData"])){
            $linhas = 0;
           while($linha = mysqli_fetch_assoc($resultadoPerdidas)){
                
            $cotacaoID = $linha["cotacaoID"];
            $codCotacao = $linha["cod_cotacao"];
            $nOrcamento = $linha["numero_orcamento"];
            $cliente = $linha["cliente"];
            $clienteID = $linha["clienteID"];
            $situacao = $linha["situacao"];
            $status = $linha["status_proposta"];
            $validade = $linha["validade"];
            $data = $linha["data_lancamento"];
            $dataResponder = $linha["data_responder"];
            $DataEnvio = $linha["data_envio"];
            $DataFechamento = $linha["data_fechamento"];
            $desconto = $linha['desconto'];
            $valor = $linha['valorTotalComDesconto'];
            $comprador = $linha['compradorID'];
            $negociacao = $linha['dias_negociacao'];
            $qtdCotacaoPerdidas = $linha['qtdPerdidas'];
            $vlrTotalCotacao = $linha['totalVlrCotacao'];
            
            
          
            
          
         

         
           ?>

                    <tr id="linha_pesquisa">

                        <td style="width: 100px;">
                            <p">
                                <font size="3" style="margin-left:20px"> <?php echo ($linhas = $linhas + 1) , " º"?>
                                </font>
                                </p>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($cliente);?> </font>
                            </p>
                        </td>

                        <td style="width:200px;">
                            <font size="2" style="margin-left:50px"><?php echo ($qtdCotacaoPerdidas);?></font>
                        </td>

                        <td style="width:200px;">
                            <font size="2"><?php echo real_format($vlrTotalCotacao);?></font>
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>

                    </tr>
                    <?php

                    }

                   
           
        
            
            
            
                    ?>

                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Total</p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                        <td style="width: 140px;">
                            <p style="margin-left:50px;"><?php echo ($qtdPerdidas); ?></p>
                        </td>

                        <td>
                            <p><?php echo real_format($somaPerdida); ?></p>
                        </td>

                        <td>

                        </td>
                        <td>
                            <p></p>
                        </td>



                    </tr>

                    <?php

                  
                  
             }
      
             if(isset($_GET["CampoPesquisaData"])){
        ?>

                </tbody>
            </table>
            <table border="0" cellspacing="0" class="tabela_pesquisa">
                <tbody>
                    <nav id="titulos_relatorio">
                        <ul>
                            <li>
                                <p>Resumo</p>
                            </li>
                        </ul>

                    </nav>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Total de cotações</p>
                        </td>
                        <td>
                            <p>Empresa que mais cotou</p>
                        </td>
                        <td>
                            <p>Total Cotação / Ganha</p>
                        </td>
                        <td>
                            <p>Total Cotação / Ganha Parcial</p>
                        </td>

                        <td>
                            <p>Total Cotação / Perdida</p>
                        </td>
                        <td>
                            <p>Total Cotação / Aberta</p>
                        </td>

                    </tr>
                    <tr id="linha_pesquisa">
                        <td>
                            <p size="3" style="margin-left:20px"><?php echo $qtdCotacao;?></p>
                        </td>
                        <td>
                            <p>
                                <font size="2"><?php echo $qtdEmpresa;?><i style="margin-left: 5px;"
                                        class="fa-solid fa-trophy"></i></font>
                            </p>
                        </td>

                        <td>
                            <p style="margin-left:50px">
                                <font size="2"><?php 
                                $totalCalculo =  $qtdGanhas * 100;
                                $total = $totalCalculo / $qtdCotacao;
                                echo real_percent($total);
                                ?></font>
                            </p>
                        </td>
                        <td>
                            <p style="margin-left:50px">
                                <font size="2"><?php 
                                $totalCalculo =  $qtdGanhasParcial * 100;
                                $total = $totalCalculo / $qtdCotacao;
                                echo real_percent($total);
                                ?></font>
                            </p>
                        </td>

                        <td>
                            <p style="margin-left:50px">
                                <font size="2"><?php 
                                $totalCalculo =  $qtdPerdidas * 100;
                                $total = $totalCalculo / $qtdCotacao;
                                echo real_percent($total);
                                ?></font>
                            </p>
                        </td>
                        <td>
                            <p style="margin-left:50px">
                                <font size="2"><?php 
                                $totalCalculo =  $qtdAberta * 100;
                                $total = $totalCalculo / $qtdCotacao;
                                echo real_percent($total);
                                ?></font>
                            </p>
                        </td>

                    </tr>


                </tbody>
                <?php } ?>
            </table>
        </form>

    </main>
</body>
<?php include '../_incluir/funcaojavascript.jar'; ?>
<script>
//abrir uma nova tela de cadastro
function abrepopupCadastroProduto() {

    var janela = "cadastro_produto.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupEditarProduto() {

    var janela = "editar_produto.php?codigo=<?php echo $idProduto ?>";
    window.open(janela, 'popuppageEditarProduto',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>