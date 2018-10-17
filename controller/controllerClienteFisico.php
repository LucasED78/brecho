<?php

    /*
        Projeto: Brechó
        Autor:  Felipe Monteiro
        Data: 10/10/2018
        Objetivo: controlar as ações da página de cadastro de usuario
        
    */

    class controllerClienteFisico{
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/clienteFisicoClass.php');
			require_once($diretorio.'model/enderecoClass.php');
			require_once($diretorio.'model/dao/enderecoDAO.php');
            require_once($diretorio.'model/dao/clienteFisicoDAO.php');
                    
        }
        
		//função que insere um cliente
        public function inserirCliente(){
			//verifica se o método é POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
            	//resgatando os valores da caixas de texto
                $nome = $_POST['txtNome'];
                $sobrenome = $_POST['txtSobrenome'];
                $telefone = $_POST['txtTelefone'];
                $celular = $_POST['txtCelular'];
                $email = $_POST['txtEmail'];
                $cpf = $_POST['txtCpf'];
                $dataNascimento = $_POST['txtDataNasc'];
                $login = $_POST['txtUsuario'];
                $senha = $_POST['txtSenha'];
                $sexo = $_POST['rb_sexo'];
				$cep= $_POST['txtCep'];
				$bairro = $_POST['txtbairro'];
                $logradouro= $_POST['txtLogradouro'];
                $estado= $_POST['txtEstado'];
                $cidade= $_POST['txtCidade'];
                $numero= $_POST['txtNumero'];
                $complemento= $_POST['txtComplemento'];
            
            }
            
            //Instancia da classe Cliente Fisico
            $clienteFisicoClass = new ClienteFisico();
			$enderecoClass = new Endereco();
            
			//setando os atributos do cliente
            $clienteFisicoClass->setNome($nome);
            $clienteFisicoClass->setSobrenome($sobrenome);
            $clienteFisicoClass->setTelefone($telefone);
            $clienteFisicoClass->setCelular($celular);
            $clienteFisicoClass->setEmail($email);
            $clienteFisicoClass->setCpf($cpf);
            $clienteFisicoClass->setDataNascimento($dataNascimento);
            $clienteFisicoClass->setLogin($login);
            $clienteFisicoClass->setSenha($senha);
            $clienteFisicoClass->setSexo($sexo);
			
			//setando os atributos do endereço
			$enderecoClass->setCep($cep);
			$enderecoClass->setBairro($bairro);
            $enderecoClass->setLogradouro($logradouro);
            $enderecoClass->setEstado($estado);
            $enderecoClass->setCidade($cidade);
            $enderecoClass->setNumero($numero);
            $enderecoClass->setComplemento($complemento);
			
            //instancia da classe ClienteFicicoDAO
            $clienteFisicoDAO = new ClienteFisicoDAO();
			
			//instância da classe EnderecoDAO
			$enderecoDAO = new EnderecoDAO();
			
            //Chamada da função para inserir dados
           	$idCliente = $clienteFisicoDAO->Insert($clienteFisicoClass);
			$idEndereco = $enderecoDAO->Insert($enderecoClass);
			
			$clienteFisicoDAO->InserirClienteEndereco($idCliente, $idEndereco);
        }
    
    }




?>