<?php
include("../conexao/conexao.php");
include("funcao/script.php");
//cadastrar usuario

//coletar o user do usario pela session
if(isset($_SESSION["user_portal_adm"])){
	if($_SESSION["user_portal_adm"]){
		 $id_user = $_SESSION["user_portal_adm"];
		 $select = "SELECT cl_usuario, cl_id from tb_user where cl_id = $id_user";
		 $lista_usuario = mysqli_query($conecta,$select);
		 if (!$lista_usuario){
			 die ("Falha no banco de dados");
		 }else{
		 $linha = mysqli_fetch_assoc($lista_usuario);
		 $b_user= $linha['cl_usuario'];
         }
}
}

if(isset($_POST["usuario"])){
$retorno = array();
$usuario = $_POST["usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$token = $_POST["token"];
$senha = base64_encode($senha);

    // verificar se o usuario já foi cadastrado anteriomente
    $select = "SELECT count(*) as quantidade from tb_user where cl_usuario = '$usuario'" ;
    $operacao_verificar_email = mysqli_query($conecta,$select);
    if($operacao_verificar_email){
    $linha = mysqli_fetch_assoc($operacao_verificar_email);
    $resultado = $linha['quantidade'];
    }else{
    die("erro banco de dados tb_clientes cl_email");
    }

    if($email == ""){
        $retorno["mensagem"] = "O campo Email não foi preenchido";
        }elseif($usuario ==""){
        $retorno["mensagem"] = "O campo Usuário não foi preenchido";
        }elseif($senha ==""){
        $retorno["mensagem"] = "O campo Senha não foi preenchido";
        }elseif($resultado > 0){
        $retorno["mensagem"] = "Usuario já cadastrado, favor tente outro usuario";
        }elseif($token !="2000_mpsa" ){
            $retorno["mensagem"] = "Token incorreto";
        }else{
        $inserir = "INSERT INTO tb_user";
        $inserir .= "(cl_data_cadastro,cl_usuario,cl_senha,cl_email)";
        $inserir .= " VALUES ";
        $inserir .= "('$hoje','$usuario','$senha','$email' )";
    
        $operacao_inserir = mysqli_query($conecta, $inserir);
        if($operacao_inserir){
              $retorno["sucesso"] = true;
              $retorno["mensagem"] = "Usuario cadastrado com sucesso";
        }else{
            $retorno["sucesso"] = false;
        }
    }

echo json_encode($retorno);
   
}



//consulta produto
if(isset($_GET["csta_prod"])){
    $pesquisa = $_GET["csta_prod"];
    $select = "SELECT p.cl_data_cadastro,p.cl_destaque,p.cl_ativo,p.cl_id,p.cl_categoria, p.cl_descricao, c.cl_descricao as as_descricao_categoria, f.cl_descricao as as_descricao_fabricante, p.cl_fabricante, 
    p.cl_titulo, p.cl_imagem, p.cl_destaque from tb_produto as 
    p inner join tb_fabricante as f on f.cl_id = p.cl_fabricante inner join tb_categoria as c on c.cl_id = p.cl_categoria
    WHERE p.cl_titulo LIKE '%{$pesquisa}%' or p.cl_id = '%($pesquisa)%' ";
    $operacao_select_produto = mysqli_query($conecta, $select);
        if(!$operacao_select_produto){
            die("Falha na consulta ao banco de dados || tb_produto query id = 222");
        }
    }
    
//consulta categoria
if(isset($_GET["csta_ctgr"])){
    $descricao = $_GET["csta_ctgr"];
    $select = "SELECT * from tb_categoria WHERE cl_descricao LIKE '%{$descricao}%' ";
    $resultado_select = mysqli_query($conecta, $select);
        if(!$resultado_select){
            die("Falha na consulta ao banco de dados || tb_categoria query id= 333");
        }
    }