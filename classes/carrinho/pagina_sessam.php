<?php 
// verificando se o codigo do produto NÃO está vazio
if (!empty($_GET['id'])) {
	// inserindo o código do produto na variável $cd_prod
	$cd_prod=$_GET['id'];
	
	// se a sessão carrinho não estiver preenchida(setada)
	if (!isset($_SESSION['carrinho'])) {
		  // será criado uma sessão chamado carrinho para receber um vetor
		  $_SESSION['carrinho'] = array();
	}
	// se a variavel $cd_prod não estiver setado(preenchida)
	if (!isset($_SESSION['carrinho'][$cd_prod])) {
		
		// será adicionado um produto ao carrinho
		$_SESSION['carrinho'][$cd_prod]=1;
	}
	// caso contrario, se ela estiver setada, adicione novos produtos
	else {
		  $_SESSION['carrinho'][$cd_prod]+=1;

	}
		// incluindo o arquivo 'mostraCarrinho.php'
		include 'mostra_carrinho.php';
	} else {
		//mostrando o carrinho	vazio	
	//	include 'mostraCarrinho.php';
	}

?>