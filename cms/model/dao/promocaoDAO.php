<?php
	class PromocaoDAO{
		public function __construct(){
			require_once('bdClass.php');
		}
		
		public function selectAll(){
			//instancia da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco de dados
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que seleciona os produtos
			$sql = 'SELECT DISTINCT p.idProduto, p.nomeProduto, p.preco, f.caminhoImagem as imagem, pr.idPromocao, pr.status from produto as p INNER JOIN produto_fotoproduto as pi ON p.idProduto = pi.idProduto INNER JOIN fotoproduto as f ON f.idImagemProduto = pi.idImagemProduto INNER JOIN promocao as pr ON pr.idProduto = p.idProduto GROUP BY idPromocao';
			
			//armazenando o retorno dos dados em uma variável
			$resultado = $PDO_conexao->query($sql);
			
			//variável de contagem
			$cont = 0;
			
			//percorrendo os dados
			while($rsProdutos = $resultado->fetch(PDO::FETCH_OBJ)){
				$listProdutos[] = new Promocao();
				
				$listProdutos[$cont]->setId($rsProdutos->idPromocao);
				$listProdutos[$cont]->setIdProduto($rsProdutos->idProduto);
				$listProdutos[$cont]->setNome($rsProdutos->nomeProduto);
				$listProdutos[$cont]->setPreco($rsProdutos->preco);
				$listProdutos[$cont]->setImagem($rsProdutos->imagem);
				$listProdutos[$cont]->setStatus($rsProdutos->status);
				
				$cont++;
			}
			
			//retornando os dados
			return $listProdutos;
		}
		
	
		public function selectByID($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que realiza a consulta no banco através do ID de uma promoção
			$stm = $PDO_conexao->prepare('SELECT p.preco, pr.* from promocao as pr INNER JOIN produto as p ON p.idProduto = pr.idProduto WHERE pr.idPromocao = ?');
			
			//parÂmetro enviado
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			
			//execução do statement
			$stm->execute();
			
			//execução do statement
			$listProduto = $stm->fetch(PDO::FETCH_OBJ);
			
			//retornando os dados em json
			return json_encode($listProduto);
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função que insere atualiza a promoção e adiciona o percentual de desconto, data inicial e final
		public function insertPromocao(Promocao $promocao){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			$stm = $PDO_conexao->prepare('UPDATE promocao SET percentualDesconto = ?, dataInicial = ?, dataFinal = ? WHERE idPromocao = ?');
			
			//parâmetros enviados
			$stm->bindParam(1, $promocao->getDesconto());
			$stm->bindParam(2, $promocao->getDtInicial());
			$stm->bindParam(3, $promocao->getDtFinal());
			$stm->bindParam(4, $promocao->getId());
			
			//execução do statement
			$stm->execute();
			
			if($stm->rowCount() != 0){
				echo('Promoção cadastrada com sucesso!!');
			}else{
				echo('Ocorreu um erro ao cadastrar a promoção!!');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		public function Delete($id){
			//instância da classe de conexão com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			//query que exclui a promoção do banco
			$stm = $PDO_conexao->prepare('DELETE FROM promocao WHERE idPromocao = ?');
			
			//parâmetro enviado
			$stm->bindParam(1, $id);
			
			//execução do statement
			$stm->execute();
			
			if($stm->rowCount() != 0){
				echo('Promoção excluída com sucesso!!');
			}else{
				echo('Ocorreu um erro ao excluir a promoção');
			}
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
		
		//função para atualizar o status
		public function updateStatus($status, $id){
			// instância da classe que conecta com o banco de dados
			$conexao = new ConexaoMySQL();
			
			//chamada da função que conecta com o banco
			$PDO_conexao = $conexao->conectarBanco();
			
			if($status == 1){
				$stm = $PDO_conexao->prepare('UPDATE promocao SET status = 0 WHERE idPromocao = ?');
			}else{
				$stm = $PDO_conexao->prepare('UPDATE promocao SET status = 1 WHERE idPromocao = ?');
			}

			//parâmetros enviados
			$stm->bindParam(1, $id);
			
			//executando o statement
			$stm->execute();
			
			//fechando a conexão
			$conexao->fecharConexao();
		}
	}
?>