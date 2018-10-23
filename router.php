<?php

	$controller = $_GET['controller'];	
	
	
    switch($controller){
		case 'enquete':
			$modo = $_GET['modo'];
			require_once('controller/controllerEnquete.php');
			switch($modo){
				case 'qtdA':
					$controllerEnquete = new controllerEnquete();
					$controllerEnquete->atualizarQtdA();
				break;
				
				case 'qtdB':
					$controllerEnquete = new controllerEnquete();
					$controllerEnquete->atualizarQtdB();
				break;
					
				case 'qtdC':
					$controllerEnquete = new controllerEnquete();
					$controllerEnquete->atualizarQtdC();
				break;
					
				case 'qtdD':
					$controllerEnquete = new controllerEnquete();
					$controllerEnquete->atualizarQtdD();
				break;
			}
		break;
		
		case 'FaleConosco':
            require_once('controller/controllerFaleConosco.php');
            
            $controllerFaleConosco = new controllerFaleConosco();
            $controllerFaleConosco->inserirFaleConosco();

        break;
            
        case 'ClienteFisico':
			$modo = $_GET['modo'];
            require_once('controller/controllerClienteFisico.php');
            switch($modo){
				case 'cadastrar':
					$controllerClienteFisico = new controllerClienteFisico();
					$controllerClienteFisico->inserirCliente();
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerClienteFisico = new controllerClienteFisico();
					$listCliente = $controllerClienteFisico->listarCliente($id);
					
					echo($listCliente);
				break;
					
				case 'atualizar':
					$controllerClienteFisico = new controllerClienteFisico();
					$controllerClienteFisico->atualizarCliente();
				break;
			}
            
		break;
		
		case 'ClienteJuridico':
			$modo = $_GET['modo'];
			require_once('controller/controllerClienteJuridico.php');
			switch($modo){
				case 'cadastrar':
					$controllerClienteJuridico = new controllerClienteJuridico();
					$controllerClienteJuridico->inserirCliente();
				break;
					
				case 'buscar':
					$id = $_POST['id'];
					
					$controllerClienteJuridico = new controllerClienteJuridico();
					$listCliente = $controllerClienteJuridico->buscarCliente($id);
					
					echo($listCliente);
				break;
					
				case 'atualizar':
					$controllerClienteJuridico = new controllerClienteJuridico();
					$controllerClienteJuridico->atualizarCliente();
				break;
			}
		break;
			
		case 'avaliação':
			$modo = $_GET['modo'];
			require_once('controller/controllerAvaliacao.php');
			switch($modo){
				case 'cadastrar':
					$controllerAvaliacao = new controllerAvaliacao();
					$controllerAvaliacao->inserirProduto();
				break;
				
				case 'listarCor':
					$controllerAvaliacao = new controllerAvaliacao();
					$listCor = $controllerAvaliacao->listarCor();
					
					echo($listCor);
				break;
					
				case 'listarMarca':
					$controllerAvaliacao = new controllerAvaliacao();
					$listMarca = $controllerAvaliacao->listarMarca();
					
					echo($listMarca);
				break;
					
				case 'listarCategoria':
					$controllerAvaliacao = new controllerAvaliacao();
					$listCategoria = $controllerAvaliacao->listarCategoria();
					
					echo($listCategoria);
				break;
					
				case 'buscarTamanho':
					$tipo = $_GET['tipo'];
					$controllerAvaliacao = new controllerAvaliacao();
					$listTamanho = $controllerAvaliacao->listarTamanho($tipo);
					
					echo($listTamanho);
				break;
			}
            
        case 'login':
            require_once('controller/controllerLogin.php');
            $modo = $_GET['modo'];
            switch($modo){
				case 'logar':
					$controllerLogin = new controllerLogin();
					$controllerLogin->BuscarConta();
				break;
					
				case 'deslogar':
					$controllerLogin = new controllerLogin();
					$controllerLogin->deslogar();
				break;
			}
            
            
		break;
			
			
		case 'NossasLojas':
			require_once('controller/controllerNossasLojas.php');
			$modo = $_GET['modo'];
			switch($modo){
				case 'buscarCidade':
					$estado = $_POST['estado'];
					$controllerNossasLojas = new ControllerNossasLojas();
					$listCidade = $controllerNossasLojas->listarCidades($estado);
					
					echo($listCidade);
				break;
					
				case 'buscarLoja':
					$cidade = $_POST['cidade'];
					
					$controllerNossasLojas = new ControllerNossasLojas();
					$listLoja = $controllerNossasLojas->listarLojas($cidade);
					
					echo($listLoja);
				break;
			}
		break;
        
    }
?>