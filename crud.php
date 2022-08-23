<?php 
include("conexao/conexao.php");
//consulta produto aba filtro destaque  query id 1
$produtos = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_destaque = '1' ";
$resultado_destaque = mysqli_query($conecta, $produtos);
	if(!$resultado_destaque){
	die("Falha na consulta ao banco de dados || tb_produto  query id 1");
}

//consulta produto baner categoria // query id 2 
$select = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_categoria = '1' ";
$resultado_categoria_1 = mysqli_query($conecta, $select);
	if(!$resultado_categoria_1){
	die("Falha na consulta ao banco de dados || tb_produto  query id 2");
}

//consulta produto baner categoria //  query id 3
$select = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_categoria = 4 ";
$resultado_categoria_2 = mysqli_query($conecta, $select);
	if(!$resultado_categoria_2){
	die("Falha na consulta ao banco de dados || tb_produto query id 3");
}

//consulta produto baner categoria //  query id 4
$select = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem
WHERE p.cl_categoria = 3 ";
$resultado_categoria_3 = mysqli_query($conecta, $select);
	if(!$resultado_categoria_3){
	die("Falha na consulta ao banco de dados || tb_produto query id 4");
}


//consulta produto rand aba diversos query id 5
$produtos = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem ORDER BY RAND() LIMIT 12";
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

