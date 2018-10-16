<?php

    class EnderecoDAO{
        public function __construct(){
            require_once('bdClass.php');
        }
        
        public function Insert(Endereco $endereco){
        
        //Instanciando a classe de conexão com o banco
            $conexao= new ConexaoMySQL();
            
            //chamando a função para conectar com o banco
            $PDO_conexao = $conexao->conectarBanco();
            
            //Criando um statement e preparando para inserir no banco
            $stm = $PDO_conexao->prepare('insert into endereco (logradouro,bairro,cidade,estado,numero,complemento,latitude,longitude,cep,idTipoEndereco) values (?,?,?,?,?,?,?,?,?,?)');
            
            $stm->bindParam(1, $endereco->getLogradouro());
            $stm->bindParam(2, $endereco->getBairro());
            $stm->bindParam(3, $endereco->getCidade());
            $stm->bindParam(4, $endereco->getEstado());
            $stm->bindParam(5, $endereco->getNumero());
            $stm->bindParam(6, $endereco->getComplemento());
            $stm->bindParam(7, $endereco->getLatitude());
            $stm->bindParam(8, $endereco->getLongitude());
            $stm->bindParam(9, $endereco->getCep());
            $stm->bindParam(10, $endereco->getIdTipoEndereco());
                        
            
            if($stm->execute()){
                header("location:index.php");
                $idEndereco =$PDO_conexao->lastInsertId();
                return $idEndereco;
                
            }else{
                echo("Erro ao enviar");   
            }
            
            $conexao->fecharConexao();
            
        }
    
    }




?>