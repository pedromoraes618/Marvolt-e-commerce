<?php 
include("conexao/conexao.php");
//consulta produto aba filtro destaque  query id 1

if(isset($_SESSION["user_cliente_portal"])){

	if($_SESSION["user_cliente_portal"]){
		 $id_user = $_SESSION["user_cliente_portal"];
		 $select = "SELECT * from tb_cliente where cl_id = $id_user";
		 $lista_cliente = mysqli_query($conecta,$select);
		 if (!$lista_cliente){
			 die ("Falha no banco de dados");
		 }
		 $linha =  mysqli_fetch_assoc($lista_cliente);
		 $b_cliente =utf8_encode($linha['cl_nome_fantasia']);
		 $b_id_cliente= $linha['cl_id'];
		 $b_cliente_nome_fantasia = utf8_encode($linha['cl_nome_fantasia']);
		 $b_cliente_razao_social = utf8_encode($linha['cl_razao_social']);
         $b_cliente_cnpj = $linha['cl_cnpj'];
		 $b_cliente_ie = $linha['cl_inscricao_estadual'];
         $b_cliente_telefone = $linha['cl_telefone'];
		 $b_cliente_cep = $linha['cl_cep'];
		 $b_cliente_bairro = utf8_encode($linha['cl_bairro']);
		 $b_cliente_cidade = utf8_encode($linha['cl_cidade']);
         $b_cliente_email = $linha['cl_email'];
		 $b_cliente_logo = $linha['cl_dir_logo'];
		 if($b_cliente_logo == ""){
			$b_cliente_logo = "padrao.png";	
		 }
	 ?>
<?php    
	
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


/*cadastro de cliente*/
//funcao para verificar se o email já foi cadastrado anteriomente
function consultarEmail($email){
    include "conexao/conexao.php";
    $select = "SELECT count(*) as quantidade from tb_cliente where cl_email = '$email' " ; 
    $operacao_verificar_email = mysqli_query($conecta,$select);
    if($operacao_verificar_email){
     $linha = mysqli_fetch_assoc($operacao_verificar_email);
     $resultado = $linha['quantidade'];
    }else{
        die("erro banco de dados tb_clientes cl_email");
    }
    return $resultado;
}

function consultarCnpj($cnpj){
    include "conexao/conexao.php";
    $select = "SELECT count(*) as quantidade from tb_cliente where cl_cnpj = '$cnpj' " ; 
    $operacao_verificar_cnpj = mysqli_query($conecta,$select);
    if($operacao_verificar_cnpj){
     $linha = mysqli_fetch_assoc($operacao_verificar_cnpj);
     $resultado = $linha['quantidade'];
    }else{
        die("erro banco de dados tb_clientes cl_email");
    }
    return $resultado;
}


//cadastrar cliente
if(isset($_POST["inscricao_estadual"])){
	$hoje = date('Y-m-d');
	$retorno = array();
    $razao_social = ($_POST["razao_social"]);
    $nome_fantasia =  utf8_decode($_POST["nome_fantasia"]);
    $cnpj = $_POST["cnpj"];
	$inscricao_municipal = $_POST["inscricao_municipal"];
	$inscricao_estadual = $_POST["inscricao_estadual"];
	$telefone = $_POST["telefone"];
	$outro_telefone = $_POST["outro_telefone"];
	$telefone_fixo = $_POST["telefone_fixo"];
	$bairro = $_POST["bairro"];
	$endereco = utf8_decode($_POST["endereco"]);
	$numero = $_POST["numero"];
	$estado = utf8_decode($_POST["estado"]);
	$cidade = utf8_decode($_POST["cidade"]);
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$cep = $_POST["cep"];
	$verifica_cnpj = $_POST["verifica_cnpj"];
	
	
	//se a empresa for isento
	if(!isset($_POST['isento'])){
		$isento = 0; //0 para não isento
	}else{
		$isento = 1;//1 para isento
	}

	if(!isset($_POST['privacidade'])){
		$privacidade = 0; // não definido
	}else{
		$privacidade = 1;//1 defindio *obrigatorio
	}

	if(!isset($_POST['receber_email'])){
		$receber_email = 0; // não receber email
	}else{
		$receber_email = 1;//1 receber email opcional
	}

	//tipo de cliente 0 jurido 1 fisico
	
	//explodir caracteres do campo cnpj 
	if(strlen($cnpj)==18){
	$div1 = explode(".",$cnpj);
	$cnpj = $div1[0]."".$div1[1]."".$div1[2];
	$div2 = explode("/",$cnpj);
	$cnpj = $div2[0]."".$div2[1];
	$div3 = explode("-",$cnpj);
	$cnpj = $div3[0]."".$div3[1];
	}
    $senha = base64_encode($senha);//criptografar a senha

    if($razao_social == ""){
			$retorno["mensagem"] = "O campo Razão social não foi preenchido";
		}elseif($nome_fantasia ==""){
			$retorno["mensagem"] = "O campo Nome fantasia não foi preenchido";
		}elseif($cnpj ==""){
			$retorno["mensagem"] = "O campo Cnpj não foi preenchido";
		}elseif($isento == 0 && $inscricao_estadual ==""){
			$retorno["mensagem"] = "O campo Inscrição Estadual não foi preenchido";
		}elseif($telefone ==""){
			$retorno["mensagem"] = "O campo Telefone não foi preenchido";
		}elseif($bairro ==""){
			$retorno["mensagem"] = "O campo Bairro não foi preenchido";
		}elseif($endereco ==""){
			$retorno["mensagem"] = "O campo Endereço não foi preenchido";
		}elseif($numero ==""){
			$retorno["mensagem"] = "O campo Número não foi preenchido";
		}elseif(strlen($cnpj)!=14){ //verificar se o cnpj está completo
			$retorno["mensagem"] = "Cnpj incorreto";
		}elseif($verifica_cnpj != 1){//verificar se o cnpj foi encontrado via api
			$retorno["mensagem"] = "Cnpj não encontrado";
		}elseif($estado ==0){
			$retorno["mensagem"] = "O estado não foi selecionado";
		}elseif($cidade ==""){
			$retorno["mensagem"] = "O campo Cidade não foi preenchido";
			//validação do email
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$retorno["mensagem"] = "Email invalido";
		}elseif($privacidade == 0){
			$retorno["mensagem"] = "É necessario aceitar os termos de política e privacidade do site";
		}elseif(consultarEmail($email)>0){
			$retorno["mensagem"] = "Esse Email já foi cadastrado";
		}elseif(strlen($cep)!=9 and ($cep != "")){
			$retorno["mensagem"] = "CEP está incoreto";
		}elseif(consultarCnpj($cnpj)>0){//verificar se o cnpj já está cadastrado
			$retorno["mensagem"] = "Esse Cnpj já está cadastrado";
		}else{

	
	

		$inserir = "INSERT INTO tb_cliente ";
		$inserir .= "(cl_data_cadastro,cl_razao_social,cl_nome_fantasia,cl_cnpj,cl_inscricao_estadual,cl_inscricao_municipal,cl_logadouro,cl_numero,
		cl_bairro,cl_telefone,cl_outro_telefone,cl_telefone_fixo,cl_estadoID,cl_cidade,cl_email,cl_tipo_cliente,cl_senha,cl_isento,cl_privacidade,cl_rcb_email,cl_cep)";
		$inserir .= " VALUES ";
		$inserir .= "('$hoje','$razao_social','$nome_fantasia','$cnpj','$inscricao_estadual','$inscricao_municipal','$endereco','$numero','$bairro','$telefone','$outro_telefone',
		'$telefone_fixo','$estado','$cidade','$email' ,'0' ,'$senha','$isento','$privacidade','$receber_email','$cep')";
		$operacao_inserir = mysqli_query($conecta, $inserir);
		if($operacao_inserir){
		$retorno["sucesso"] = true;
		}else{
		$retorno["sucesso"] = false;
		}
}
	
echo json_encode($retorno);
   
} 



/*Salvar a avaliacao no banco de dados */
if(isset($_POST['descricao_avaliacao'])){
    $retorno = array();
    $hoje = date('y-m-d');
    $descricao = utf8_decode($_POST['descricao_avaliacao']);
    $titulo = $_POST['titulo_avaliacao'];
    $id_cliente = $_POST['id_cliente_avaliacao'];
    $id_produto = $_POST['id_produto_avaliacao'];
	if($titulo ==""){
		$retorno["mensagem"] = "Não foi informado o Titulo";
	}elseif($descricao == ""){
		$retorno["mensagem"] = "Não foi informado a descrição";
	}else{
  
		$insert = "INSERT INTO tb_avaliacao ";
		$insert .= "(cl_data,cl_cliente,cl_titulo,cl_produtoID,cl_descricao)";
		$insert .= " VALUES ";
		$insert .= "('$hoje','$id_cliente','$titulo','$id_produto','$descricao' )";
		
		$operacao_insert = mysqli_query($conecta, $insert);
		if($operacao_insert){
			$retorno["sucesso"] = true;
			$retorno["mensagem"] = "Obrigado por avaliar nosso produto";
		}else{
			$retorno["sucesso"] = false;
		}   
	}
    echo json_encode($retorno);
}


/*Salvar as informacoes dos produto do carrinho no banco de dados */
if(isset($_POST['cor_prod'])){
	$retornar = array();
    $cor_prod =utf8_encode($_POST['cor_prod']);
    $tamanho_prod = utf8_encode($_POST['tamanho_prod']);
    $obs_prod = utf8_encode($_POST['observacao_prod']);
    $quantidade = $_POST['quantidade_prod'];
	$id_prod = $_POST['id_produto'];
	
	if($quantidade == ""){
		$retornar["mensagem_1"] = "Favor informe o campo quantidade";
	}else{
		
    $alterar = "UPDATE tb_carrinho set cl_produto_cor = '{$cor_prod}', cl_produto_tamanho = '{$tamanho_prod}',cl_produto_obs = '{$obs_prod}',cl_quantidade='{$quantidade}' where cl_id = $id_prod";
    $operacao_inserir = mysqli_query($conecta, $alterar);
        if($operacao_inserir){
			$retornar["sucesso"] = true;
        }else{
			$retornar["sucesso"] = false;
		}
    }
	echo json_encode($retornar);
}


  if(isset($_POST['data_entrega_finalizar_pedido'])){
	$hoje = date('Y-m-d');
	$retornar = array();
	$cliente = $_POST['cliente'];
	$sessao = $_POST['sessao'];
	$frete = $_POST['frete'];
	$forma_pagamento = $_POST['tipo_pagamento'];
	$data_entrega = $_POST['data_entrega_finalizar_pedido'];

	if($data_entrega!=""){
	$div1 = explode("/",$_POST['data_entrega_finalizar_pedido']);
	$data_entrega_format = $div1[2]."-".$div1[1]."-".$div1[0];
	}else{
		$data_entrega_format = $hoje;
	}

	if($data_entrega_format < $hoje){
		$retornar["mensagem"] = "Informe uma data posterior a data de hoje";
	}else{
		//explodir para o formato de data banco de dados xxxx-xx-xx
		if($data_entrega!=""){
		$div1 = explode("/",$_POST['data_entrega_finalizar_pedido']);
		$data_entrega = $div1[2]."-".$div1[1]."-".$div1[0];
		}

		//verificar se já existe um numero de pedido igual
		$codigo = random_int(5000,5000000000000);
		$insert = "INSERT INTO tb_pedido";
		$insert .= "(cl_data,cl_cliente,cl_sessao,cl_entrega,cl_frete,cl_forma_pagamento,cl_codigo,cl_status)";  //cl_status = 1 para analise, 2 para em negociacao, 3 para finalizado , 4 para cancelado
		$insert .= " VALUES ";
		$insert .= "('$hoje','$cliente','$sessao','$data_entrega','$frete','$forma_pagamento','$codigo',1 )";
		$operacao_fechar_pedido = mysqli_query($conecta, $insert);
		if($operacao_fechar_pedido){
			$retornar["sucesso"] = true;
			$retornar["codigo_pedido"] = $codigo;
		}else{
			$retornar["sucesso"] = false;
		}


		$sessao = $sessao + 1;
		$inserir = "INSERT INTO tb_carrinho ";
		$inserir .= "(cl_data,cl_cliente,cl_produtoID,cl_sessao)";
		$inserir .= " VALUES ";
		$inserir .= "('$hoje','$cliente','fechado','$sessao' )";
		$operacao_fechar_pedido = mysqli_query($conecta, $inserir);
	    if($operacao_fechar_pedido){
	 	 	}
		}
	
	echo json_encode($retornar);

}


	
//login
if(isset($_POST["email_login"])){
	$retorno = array();
    $email =  $_POST["email_login"];
    $senha =  $_POST["senha"];
   
	if($email =="" && $senha ==""){
	$retorno["mensagem"] = "Favor informe o Email e senha";

	}elseif($senha==""){
	$retorno["mensagem"] = "Campo Senha não preenchido";

	}elseif($email ==""){
	$retorno["mensagem"] = "Campo Email não preenchido";

	}else{

    $login = "SELECT * FROM tb_cliente WHERE  cl_email = '$email' or cl_cnpj = '$email' or cl_cpf = '$email'  ";
    $acesso = mysqli_query($conecta, $login);

    if( !$acesso ){
	$retorno["sucesso"] = false;
    }else{

	$retorno["sucesso"] = true;
    $linha = mysqli_fetch_assoc($acesso);
    $b_email = $linha['cl_email'];
	$b_cpf = $linha['cl_cpf'];
	$b_cnpj = $linha['cl_cnpj'];
	
    $b_senha = $linha['cl_senha'];
    $b_senha = base64_decode($b_senha);

		if (($b_email == $email or $b_cpf == $email or $b_cnpj == $email) and $b_senha == $senha){
		$_SESSION["user_cliente_portal"] = time(10000000);
		$_SESSION["user_cliente_portal"] = $linha["cl_id"];
		$retorno["loginOk"] = true;
		}else{
			$retorno["loginOk"] = false;
		}
	}
 }
 echo json_encode($retorno);
   
}


//verificar se o produto é recorrente na empresa - 1 para sim ou 0 para não
if(isset($_POST["prodR"])){
    $retornar = array();
    $codigo = $_POST["prodR"];
    //delete as informações no banco de dados
    $update = "UPDATE tb_carrinho set cl_recorrente = 1 where cl_id = $codigo";
    $resultado_recorrente = mysqli_query($conecta, $update);
    if($resultado_recorrente){
    $retornar["sucesso"] = true;
        
    }else{
        $retornar["sucesso"] = false;
    }

  echo json_encode($retornar);
}elseif(isset($_POST['prodN'])){
	$retornar = array();
    $codigo = $_POST["prodN"];
    //delete as informações no banco de dados
    $update = "UPDATE tb_carrinho set cl_recorrente = 0 where cl_id = $codigo";
    $resultado_recorrente = mysqli_query($conecta, $update);
    if($resultado_recorrente){
    $retornar["sucesso"] = true;
        
    }else{
        $retornar["sucesso"] = false;
    }

  echo json_encode($retornar);
}




if(isset($_POST['acao'])){
	$hoje = date('Y-m-d');
	$retornar = array();
	$acao = $_POST['acao'];

	// //adicionar produto no carrinho 
	//funcao para verificar se é o mesmo produto que está sendo adicionado duas vez/ se for não realizar o insert no banco de dados
function verificaProd($cliente,$sessao,$id_prod){
	include "conexao/conexao.php";
	//pegar se o usuario está adicionado o mesmo produto a mesma sessao
		//Sera adicionado o produto apenas se o id for diferente dos produto já adicionados na mesma sessao
		$select = "SELECT count(*) as qtd from tb_carrinho where cl_cliente = '$cliente' and cl_sessao = '$sessao' and cl_produtoID = '$id_prod'";
		$resultado_produto_sessao = mysqli_query($conecta, $select);
		if(!$resultado_produto_sessao){
		include "classes/erro/504.php";
		}else{
		$linha = mysqli_fetch_assoc($resultado_produto_sessao);
		$qtd_prod = $linha['qtd'];
		return $qtd_prod;
		}
}
//funcao para verificar a quantidade de produtos no carrinho
function vericarQtdProd($clienteID,$sessao){
	include "conexao/conexao.php";
	$select = "SELECT sum(cl_quantidade) as qtd_prod from tb_carrinho where cl_cliente = $clienteID and cl_sessao = $sessao and cl_produtoID > 0 ";
	$resultado_qtd_carrinho = mysqli_query($conecta, $select);
	if($resultado_qtd_carrinho){
	$linha = mysqli_fetch_assoc($resultado_qtd_carrinho);
	$qtd_carrinho = $linha['qtd_prod'];
	return $qtd_carrinho;

	}
}


	if(($acao == "add")){
		$id_prod = $_POST['id'];
		$clienteID = $_POST['cliente'];
		$sessao = $_POST['sessao'];


			if(verificaProd($clienteID,$sessao,$id_prod) == 0 ){
			$inserir = "INSERT INTO tb_carrinho";
			$inserir .= "(cl_data,cl_cliente,cl_produtoID,cl_sessao,cl_quantidade)";
			$inserir .= " VALUES ";
			$inserir .= "('$hoje','$clienteID','$id_prod','$sessao',1)";
			$operacao_inserir = mysqli_query($conecta, $inserir);

		
				if($operacao_inserir){
					$retornar["sucesso"] = true;
					$retornar["car"] = vericarQtdProd($clienteID,$sessao);
			
				}else{
					$retornar["sucesso"] = false;
				}
		
			}else{
				$retornar["mensagem"] = true;
			}
		}elseif($acao =="del"){
			$id_prod = $_POST['id'];
			$clienteID = $_POST['cliente'];
			$sessao = $_POST['sessao'];
		
				$delete = "DELETE FROM tb_carrinho where cl_id = $id_prod and cl_cliente = $clienteID and cl_sessao = $sessao ";
				$operacao_delete = mysqli_query($conecta, $delete);
				if($operacao_delete){
					$retornar["sucessoDel"] = true;
					$retornar["car"] = vericarQtdProd($clienteID,$sessao);
				}else{
					$retornar["sucessoDel"] = false;
				}
		}
	echo json_encode($retornar);
	
            
}


//verificar se existe o da solcitação
if(isset($_POST['cds'])){
	$retornar = array();
	$codigo = $_POST['cds'];  //abrivação de cds codigo da solicitacao
	$select = "SELECT count(*) as qtd from tb_pedido where cl_codigo = $codigo and cl_verifica = 0";
	$resultado_select_pedido = mysqli_query($conecta, $select);
	if($resultado_select_pedido){
		$retornar["sucesso"] = true;
		$linha = mysqli_fetch_assoc($resultado_select_pedido);
		$qtd = $linha['qtd'];
		if($qtd>0){
			$retornar["verificar"] = true;
		}else{
			$retornar["verificar"] =false;
		}
		
	}else{
		$retornar["sucesso"] = false;
	}
	echo json_encode($retornar);
}

//adicionar 1 para pedidos que foram finalizados
if(isset($_POST['verifica'])){
	$codigo = $_POST["verifica"]; //
	$update = "UPDATE tb_pedido set cl_verifica = 1 where cl_codigo = $codigo"; // irá atualizar para 1 o valor da coluna cl_verfica, coluna que tem como função verifcar se o pedido foi finalizado
	$operacao_update_verifica = mysqli_query($conecta, $update);
};

//cancelar a solicitacao
if(isset($_POST['acaoSl'])){
	if($_POST['acaoSl']=="cancelar"){
	$retornar = array();
	$id_solicitacao = $_POST["idSolicitacao"];
	//delete as informações no banco de dados
	$update = "UPDATE tb_pedido set cl_status = 4 where cl_id = $id_solicitacao";
	$resultado_cancelar_s = mysqli_query($conecta, $update);
	if($resultado_cancelar_s){
	$retornar["sucesso"] = true;
	}else{
	$retornar["sucesso"] = false;
	}
	echo json_encode($retornar);
	}

}

//Reativar a solicitacao
if(isset($_POST['acaoSl'])){
	if($_POST['acaoSl']=="reativar"){
		$retornar = array();
		$id_solicitacao = $_POST["idSolicitacao"];
		//delete as informações no banco de dados
		$update = "UPDATE tb_pedido set cl_status = 1 where cl_id = $id_solicitacao";
		$resultado_cancelar_s = mysqli_query($conecta, $update);
		if($resultado_cancelar_s){
		$retornar["sucesso"] = true;
		}else{
			$retornar["sucesso"] = false;
		}
		echo json_encode($retornar);
	}

}



//mandar o erro para o log
if(isset($_POST['erroLog'])){
	$hoje = date('Y-m-d');
	$mensagem = $_POST['erroLog'];
	$inserir = "INSERT INTO tb_log";
	$inserir .= "(cl_data,cl_descricao)";
	$inserir .= " VALUES ";
	$inserir .= "('$hoje','$mensagem')";
	$operacao_inserir_log = mysqli_query($conecta, $inserir);
}

//upload de img do cliente
if(isset($_POST['dirimguser'])){
	$retorno = array();
	$arquivo_img = $_POST['dirimguser'];
	$clienteId = $_POST['clienteid'];
	$update = "UPDATE tb_cliente set cl_dir_logo = '$arquivo_img' where cl_id = $clienteId ";
	$resultado_upload_img = mysqli_query($conecta, $update);
	if($resultado_upload_img){
		$retornar["sucesso_upload_img"] = true;
		}else{
		$retornar["sucesso_upload_img"] = false;
		}
	echo json_encode($retornar);
}