<?php
	if(isset($_SESSION['sexo'])){
		
	$genero = $_SESSION['sexo'];

	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
	require_once($diretorio.'controller/controllerTema.php');
	$listTema = new controllerTema();
	$rsTema = $listTema->listarTemas($genero);
?>

<style>
	
	/**************************** BOTÕES *******************************/
	.comprar_produto{
		border-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.comprar_produto:hover{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.carrinho_produto{
		border-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.carrinho_produto:hover{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.enviar_resposta{
		border-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.enviar_resposta:hover{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.pesquisa_cabecalho_icone{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.botao_compra{
		background-color: <?php echo($rsTema->getCor()) ?>
	}
	
	.botao_enviar_fale{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.botao_pesquisa_categoria{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	
	.botao_login{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	/***************************** OUTROS DETALHES ***************************/
	
	.linha{
		border-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.caixa_titulo_linha{
		border-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.titulo_categoria{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.titulo_categoria_primeiro{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
	
	.produto_carrinho{
		background-color: <?php echo($rsTema->getCor()) ?>;
	}
</style>


<?php
	}