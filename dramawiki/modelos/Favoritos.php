<?php

    class Favoritos{

        private $id;
        private $id_dorama;
        private $id_usuario;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getId_Dorama(){
            return $this->id_dorama;
        }

        public function setId_Dorama($id_dorama){
            $this->id_dorama = $id_dorama;
        }

        public function getId_Usuario(){
            return $this->id_usuario;
        }

        public function setId_Usuario($id_usuario){
            $this->id_usuario = $id_usuario;
        }

    }

?>