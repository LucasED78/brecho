<?php
	class controllerProduto{
		public function __construct(){
			$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
			require_once($diretorio.'model/produtoClass.php');
			require_once($diretorio.'model/dao/produtoDAO.php');
		}
		
		public function listarProdutos(){
			$produtoDAO = new ProdutoDAO();
			$listProduto = $produtoDAO->selectAll();
			
			//contador
			$cont = 0;
			
			//percorrendo a lista de produtos
			while($cont < count($listProduto)){
				//separando o "../" e armazenando o caminho da imagem em uma variável
				$novaImagem = explode('../', $listProduto[$cont]->getImagem());
				
				//percorrendo a variável com o novo caminho e armazenando em uma nova variável
				foreach($novaImagem as $img){
					//adicionanvo a imagem com o novo caminho á lista de produtos
					$listProduto[$cont]->setImagem($img);
				}
				
				//incrementando o contador
				$cont++;
			}
			
			
			//retornando a lista dos produtos
			return $listProduto;
		}
		
		public function buscarProduto($id){
			$produtoDAO = new ProdutoDAO();
			$listProduto = $produtoDAO->selectByID($id);
			
			return $listProduto;
		}
	}
?>