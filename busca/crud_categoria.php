<?php 
include("conexao/conexao.php");

//consulta categoria pesquisa
function categoria($id){
include("conexao/conexao.php");
$categoria= "SELECT * from tb_categoria where cl_id = $id ";
$resultado_categoria= mysqli_query($conecta, $categoria);
if(!$resultado_categoria){
die("Falha na consulta ao banco de dados || tb_categoria");
}else{
$linha = mysqli_fetch_assoc($resultado_categoria);
$categoria_descricao = utf8_encode($linha['cl_descricao']);
return $categoria_descricao;
}
}

//produtos na subcategoria
$subcategoria = "SELECT * from tb_subcategoria where cl_categoria = $b_id ";
$resultado_subcategoria= mysqli_query($conecta, $subcategoria);
if(!$resultado_subcategoria){
die("Falha na consulta ao banco de dados || tb_categoria");
}

//quantidade de produos na subcategoria
function qtd_subcategoria($b_id){
include("conexao/conexao.php");
$qtd_subcategoria = "SELECT count(*) as quantidade from tb_produto where cl_subcategoria = $b_id ";
$resultado_qtd_subcategoria= mysqli_query($conecta, $qtd_subcategoria);
if(!$resultado_qtd_subcategoria){
die("Falha na consulta ao banco de dados || tb_produto");
}else{
$linha = mysqli_fetch_assoc($resultado_qtd_subcategoria);
$qtd = $linha['quantidade'];
return $qtd;
}

}

//consulta produtos filtrado por categoria
$produtos = "SELECT p.cl_data_cadastro,p.cl_destaque,p.cl_ativo,p.cl_id,p.cl_categoria, p.cl_descricao,p.cl_codigo, e.cl_descricao as embalagem, c.cl_descricao as as_descricao_categoria, f.cl_descricao as as_descricao_fabricante, p.cl_fabricante, 
p.cl_titulo, p.cl_imagem, p.cl_destaque from tb_produto as 
p inner join tb_fabricante as f on f.cl_id = p.cl_fabricante inner join tb_categoria as c on c.cl_id = p.cl_categoria  inner join tb_embalagem as e on e.cl_id = p.cl_embalagem   where cl_categoria =  $b_id ";
$resultado_produto_categoria = mysqli_query($conecta, $produtos);
if(!$resultado_produto_categoria){
die("Falha na consulta ao banco de dados || tb_produto com inner join tb_fabricante");
	}

    //consulta produtos filtrado por subcategoria
$produtos = "SELECT p.cl_data_cadastro,p.cl_destaque,p.cl_ativo,p.cl_id,p.cl_categoria,cl_subcategoria, p.cl_descricao,p.cl_codigo, e.cl_descricao as embalagem, c.cl_descricao as as_descricao_categoria, f.cl_descricao as as_descricao_fabricante, p.cl_fabricante, 
p.cl_titulo, p.cl_imagem, p.cl_destaque from tb_produto as 
p inner join tb_fabricante as f on f.cl_id = p.cl_fabricante inner join tb_categoria as c on c.cl_id = p.cl_categoria inner join tb_embalagem as e on e.cl_id = p.cl_embalagem where cl_subcategoria =  $b_id ";
$resultado_produto_subcategoria = mysqli_query($conecta, $produtos);
if(!$resultado_produto_categoria){
die("Falha na consulta ao banco de dados || tb_produto com inner join tb_fabricante");
	}


//quantidade de produos na subcategoria
function titulo_subcategoria($b_id){
include("conexao/conexao.php");
$subcategoria = "SELECT * from tb_subcategoria where cl_id = $b_id";
$resultado_titulo_subcategoria = mysqli_query($conecta, $subcategoria);
if(!$resultado_titulo_subcategoria){
die("Falha na consulta ao banco de dados || tb_produto");
}else{
$linha = mysqli_fetch_assoc($resultado_titulo_subcategoria);
$titulo = $linha['cl_descricao'];
return $titulo;
    }
}

//quantidade de produos na subcategoria
function qtd_fabricante($b_id,$b_id_subcategoria){
include("conexao/conexao.php");
$qtd_fabricante = "SELECT count(*) as quantidade from tb_produto where cl_fabricante = $b_id and cl_subcategoria = $b_id_subcategoria ";
$resultado_qtd_fabricante= mysqli_query($conecta, $qtd_fabricante);
if(!$resultado_qtd_fabricante){
die("Falha na consulta ao banco de dados || tb_produto");
}else{
$linha = mysqli_fetch_assoc($resultado_qtd_fabricante);
$qtd = $linha['quantidade'];
return $qtd;
    }  
}

//produtos nos fabricantes
$produto_f = "SELECT p.cl_fabricante AS inner_id_fabricante,f.cl_descricao as inner_fabricante from tb_produto as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id where cl_subcategoria = $b_id  GROUP BY cl_fabricante";
$resultado_produto_f = mysqli_query($conecta, $produto_f);
if(!$resultado_produto_f){
die("Falha na consulta ao banco de dados || tb_categoria");
}
                

//produtos nos fabricantes
$select = "SELECT p.cl_titulo,p.cl_descricao,p.cl_imagem,p.cl_modelo,s.cl_descricao as subcategoria, c.cl_descricao as categoria, p.cl_codigo,f.cl_descricao as fabricante, e.cl_descricao as embalagem from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem  inner join tb_categoria as c on c.cl_id = p.cl_categoria  
inner join tb_subcategoria as s on s.cl_id = p.cl_subcategoria  where p.cl_id = $b_id ";
$resultado_descr_prod = mysqli_query($conecta, $select);
if(!$resultado_descr_prod){
die("Falha na consulta ao banco de dados || tb_produto");
}else{
$linha = mysqli_fetch_assoc($resultado_descr_prod);
$b_desc_titulo = $linha['cl_titulo'];
$b_desc_img = $linha['cl_imagem'];
$b_desc_descricao = $linha['cl_descricao'];
$b_desc_codigo = $linha['cl_codigo'];
$b_desc_fabricante = $linha['fabricante'];
$b_desc_modelo= $linha['cl_modelo'];
$b_desc_embalagem= $linha['embalagem'];
$b_desc_categoria = $linha['categoria'];
$b_desc_subcategoria = $linha['subcategoria'];
}

if(isset($_GET['subcg'])){
$b_subct = $_GET['subcg']; //subcategoria
    
//query para os produtos relacionados classe produto || pagina.php
$select = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem  
where p.cl_subcategoria = '$b_subct' ORDER BY RAND()  ";
$resultado_prod = mysqli_query($conecta, $select);
if(!$resultado_prod){
die("Falha na consulta ao banco de dados || tb_produto");
}
}


//query para realizar a busca do produto
if(isset($_GET['buscar'])){
    $b_desc_p = $_GET['buscar'];
    $select = "SELECT p.cl_titulo,p.cl_id,p.cl_descricao,p.cl_imagem,p.cl_modelo,p.cl_codigo,f.cl_descricao as fabricante,p.cl_subcategoria, e.cl_descricao as embalagem  from tb_produto 
    as p inner join tb_fabricante as f on p.cl_fabricante = f.cl_id inner join tb_embalagem as e on e.cl_id = p.cl_embalagem  
    where p.cl_titulo LIKE '%{$b_desc_p}%' ORDER BY RAND()  ";
     $resultado_busca = mysqli_query($conecta, $select);

}
    