<?php

    class ClienteFisicoDAO{
    
        public function __construct(){
            require_once('bdClass.php');
        }
        
        public function Insert(ClienteFisico $cliente){
        
            //Instancia da classe de cinexão com o banco 
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //criando um statement e preparando a querry que irá inserir os dados no banco.
            
            $stm = $PDO_conexao->prepare('insert into clientefisico (nome, sobrenome,telefone,celular,email,cpf,dataNascimento, login, senha, sexo) values (?,?,?,?,?,?,?,?,?,?)');
            
            $stm->bindParam(1, $cliente->getNome());
            $stm->bindParam(2, $cliente->getSobrenome());
            $stm->bindParam(3, $cliente->getTelefone());
            $stm->bindParam(4, $cliente->getCelular());
            $stm->bindParam(5, $cliente->getEmail());
            $stm->bindParam(6, $cliente->getCpf());
            $stm->bindParam(7, $cliente->getDataNascimento());
            $stm->bindParam(8, $cliente->getLogin());
            $stm->bindParam(9, $cliente->getSenha());
            $stm->bindParam(10, $cliente->getSexo());
//            $stm->bindParam(11, $cliente->getApp());
            
//            var_dump($cliente);
            
            if($stm->execute()){
//                header("location:index.php")
                $idCliente=$PDO_conexao->lastInsertId();
                return $idCliente;
            }else{
                echo('Ocorreu um erro ao inserir os dados do cliente');
            }
            
			$conexao->fecharConexao();
			
        }
        
        
        
        public function InserirClienteEndereco($idCliente,$idEndereco){
            //Instancia da classe de cinexão com o banco 
            $conexao = new ConexaoMySQL();
            
            //chamada da função para conectar o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //criando um statement e preparando a querry que irá inserir os dados no banco.
            $stm = $PDO_conexao->prepare('insert into clientefisico_endereco(idClienteFisico,idEndereco) values(?,?)');
            
            $stm->bindParam(1, $idCliente);
            $stm->bindParam(2, $idEndereco);
            
            $stm->execute();
			
			$conexao->fecharConexao();
            
        }
    }


?>