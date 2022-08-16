<?php 
include("conexao/conexao.php");
//consulta produto aba filtro destaque
$produtos = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_destaque = '1' ";
$resultado_destaque = mysqli_query($conecta, $produtos);
	if(!$resultado_destaque){
	die("Falha na consulta ao banco de dados || tb_produto com inner join tb_fabricante");
}


//consulta produto rand aba diversos
$produtos = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem ORDER BY RAND() LIMIT 12";
$resultado_diversos = mysqli_query($conecta, $produtos);
	if(!$resultado_diversos){
	die("Falha na consulta ao banco de dados || tb_produto com inner join tb_fabricante");
}


//consulta categoria
$categoria = "SELECT * from tb_categoria";
$resultado_categoria = mysqli_query($conecta, $categoria);
	if(!$resultado_categoria){
	die("Falha na consulta ao banco de dados || tb_categoria");
}


// if(isset($_GET['buscar'])){
// 	$select = "SELECT * from tb_produto";
// 	$resultado_pesquisa = mysqli_query($conecta,$select); 
// }

// //contar o total de registros
// $total_registros = mysqli_num_rows($resultado_pesquisa);

// //seta a quantidade de registros por pagina 6
