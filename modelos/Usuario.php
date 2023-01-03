<?php

    class Usuario{

        private $id;
        private $nome_completo;
        private $telefone;
        private $email;
        private $nome_usuario;
        private $senha;
        private $status;


        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getNome_Completo(){
            return $this->nome_completo;
        }

        public function setNome_Completo($nome_completo){
            $this->nome_completo = $nome_completo;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getNome_Usuario(){
            return $this->nome_usuario;
        }

        public function setNome_Usuario($nome_usuario){
            $this->nome_usuario= $nome_usuario;
        }

        public function getSenha(){
            return $this->senha;
        }
        
        public function setSenha($senha){
            $this->senha = $senha;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
        }

    }