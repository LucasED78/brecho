<?php
  /*
        Projeto: Brechó
        Autor:  Felipe Monteiro
        Data: 01/10/2018
        Objetivo: controlar as ações da página de enquetes

    */

    class controllerFaleConosco{
    
        public function __construct(){
            $diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
            require_once($diretorio.'model/faleConoscoClass.php');
            require_once($diretorio.'model/dao/faleConoscoDAO.php');
        }
    
        public function inserirFaleConosco(){
        
            if($_SERVER['REQUEST_METHOD']=='POST'){
            
                $nome = $_POST['txtnome'];
                $email= $_POST['txtemail'];
                $telefone = $_POST['txttelefone'];
                $sexo = $_POST['radio_sexo_fale'];
                $assunto = $_POST['txtassunto'];
                $comentario = $_POST['txtcomentario'];            
                        
            }
            
            //instancia da classe fale conosco
            $faleConoscoClass = new FaleConosco();
            
            $faleConoscoClass->setNomePessoa($nome);
            $faleConoscoClass->setEmail($email);
            $faleConoscoClass->setTelefone($telefone);
            $faleConoscoClass->setSexo($sexo);
            $faleConoscoClass->setAssunto($assunto);
            $faleConoscoClass->setComentario($comentario);
            
            
            //instancia da classe FaleConoscoDAO
            $faleConoscoDAO = new FaleConoscoDAO();
            
            //chamada da função para inserir dados
            
            $faleConoscoDAO::Insert($faleConoscoClass);
            
        }
    }






?>