<?php
    require_once('produtoClass.php');
    class Consignacao extends Produto{
        public function __construct(){
            
        }

        private $id;
        private $valor;
        private $dtInicio;
        private $dtTermino;
        private $idProduto;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setValor($valor){
            $this->valor = $valor;
        }

        public function getValor(){
            return $this->valor;
        }

        public function setDtInicio($dtInicio){
            $this->dtInicio = $dtInicio;
        }

        public function getDtInicio(){
            return $this->dtInicio;
        }

        public function setDtTermino($dtTermino){
            $this->dtTermino = $dtTermino;
        }

        public function getDtTermino(){
            return $this->dtTermino;
        }

        public function setIdProduto($idProduto){
            $this->idProduto = $idProduto;
        }

        public function getIdProduto(){
            return $this->idProduto;
        }
    }
?>