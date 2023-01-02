<?php

    class Foto{

        private $id;
        private $nome;
        private $tipo;
        private $arquivo;
        private Dorama $dorama;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getNome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }
        public function getTipo(){
            return $this->tipo;
        }
        public function setTipo($tipo){
            $this->tipo = $tipo;
        }
        public function getArquivo(){
            return $this->arquivo;
        }
        public function setArquivo($arquivo){
            $this->arquivo = $arquivo;
        }
        public function getDorama(){
            return $this->dorama;
        }
        public function setDorama($dorama){
            $this->dorama = $dorama;
        }

    }
?>