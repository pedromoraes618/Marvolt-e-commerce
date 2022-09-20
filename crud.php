<?php 
include("conexao/conexao.php");
//consulta produto aba filtro destaque  query id 1

if(isset($_SESSION["user_portal"])){

	if($_SESSION["user_portal"]){
		 $id_user = $_SESSION["user_portal"];
		 $select = "SELECT cl_usuario, cl_id from tb_cliente where cl_id = {$id_user}";
		 $lista_cliente = mysqli_query($conecta,$select);
		 if (!$lista_cliente){
			 die ("Falha no banco de dados");
		 }
		 $linha = mysqli_fetch_assoc($lista_cliente);
		 $b_cliente = $linha['cl_usuario'];
		 $b_id_cliente= $linha['cl_id'];
	 ?>
<?php    
	 }
	 //pegar a sessao do carrinho do cliente
$select = "SELECT max(cl_sessao) as sessao from tb_carrinho where cl_cliente = $b_id_cliente";
$resultado_carrinho_sessao = mysqli_query($conecta, $select);
if(!$resultado_carrinho_sessao){
    include "classes/erro/504.php";
}else{
  $linha = mysqli_fetch_assoc($resultado_carrinho_sessao);
  $sessao = $linha['sessao'];
  //se a sessao for inciado com "" a variavel sessao recebe 0 como valor
  if($sessao == ""){
   $sessao = 0;
  }
}

//pegar q quantidade de produtos que estão no carrinho
$select = "SELECT sum(cl_quantidade) as qtd_prod from tb_carrinho where cl_cliente = $b_id_cliente and cl_sessao = '$sessao' and cl_produtoID > 0 ";
$resultado_qtd_carrinho = mysqli_query($conecta, $select);
if(!$resultado_qtd_carrinho){
    include "classes/erro/504.php";
}else{
$linha = mysqli_fetch_assoc($resultado_qtd_carrinho);
$qtd_carrinho = $linha['qtd_prod'];

}

   
}


$produtos = "SELECT p.cl_titulo,p.cl_disponivel,p.cl_valor,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as
fabricante,p.cl_subcategoria, e.cl_descricao as embalagem from tb_produto
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_destaque = '1' and p.cl_ativo = '1' ";
$resultado_destaque = mysqli_query($conecta, $produtos);
if(!$resultado_destaque){
die("Falha na consulta ao banco de dados || tb_produto query id 1");
}

//consulta produto baner categoria // query id 2
$select = "SELECT p.cl_titulo,p.cl_disponivel,p.cl_valor,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as
fabricante,p.cl_subcategoria, e.cl_descricao as embalagem from tb_produto
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_categoria = '1' and p.cl_ativo = '1' ";
$resultado_categoria_1 = mysqli_query($conecta, $select);
if(!$resultado_categoria_1){
die("Falha na consulta ao banco de dados || tb_produto query id 2");
}

//consulta produto baner categoria // query id 3
$select = "SELECT p.cl_titulo,p.cl_disponivel,p.cl_valor,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as
fabricante,p.cl_subcategoria, e.cl_descricao as embalagem from tb_produto
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_categoria = 4 and p.cl_ativo = '1'";
$resultado_categoria_2 = mysqli_query($conecta, $select);
if(!$resultado_categoria_2){
die("Falha na consulta ao banco de dados || tb_produto query id 3");
}

//consulta produto baner categoria // query id 4
$select = "SELECT p.cl_titulo,p.cl_disponivel,p.cl_valor,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as
fabricante,p.cl_subcategoria, e.cl_descricao as embalagem from tb_produto
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_categoria = 3 and p.cl_ativo = '1' ";
$resultado_categoria_3 = mysqli_query($conecta, $select);
if(!$resultado_categoria_3){
die("Falha na consulta ao banco de dados || tb_produto query id 4");
}


//consulta produto rand aba diversos query id 5
$produtos = "SELECT p.cl_titulo,p.cl_disponivel,p.cl_valor,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as
fabricante,p.cl_subcategoria, e.cl_descricao as embalagem from tb_produto
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem where p.cl_ativo = '1'
ORDER BY RAND() LIMIT 12";
$resultado_diversos = mysqli_query($conecta, $produtos);
if(!$resultado_diversos){
die("Falha na consulta ao banco de dados || tb_produto query id 5");
}


//consulta categoria query id 6
$categoria = "SELECT * from tb_categoria";
$resultado_categoria = mysqli_query($conecta, $categoria);
if(!$resultado_categoria){
die("Falha na consulta ao banco de dados || tb_categoria query id 6");
}

//consulta categoria query para menu mobile id 7
$categoria = "SELECT * from tb_categoria";
$resultado_categoria_mobile = mysqli_query($conecta, $categoria);
if(!$resultado_categoria_mobile){
die("Falha na consulta ao banco de dados || tb_categoria query id 6");
}




if(isset($_POST["titulo_avaliacao"])) {
    $retorno = array();
    $retorno["mensagem"] = "favor informe o nome";
      
    
    echo json_encode($retorno);
}