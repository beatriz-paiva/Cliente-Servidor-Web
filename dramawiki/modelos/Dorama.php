<?php	

	class Dorama{

		private $id;
		private $titulo;
		private $sinopse;
		private $data_lancamento;
		private $fotos;
		private Genero $genero;

		public function setId($id){
			$this->id=$id; 
		}

		public function getId(){
			return $this->id;
		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}

		public function getTitulo(){
			return $this->titulo;
		}

		public function setSinopse($sinopse){
			$this->sinopse = $sinopse;
		}

		public function getSinopse(){
			return $this->sinopse;
		}

		public function setData_Lancamento($data_lancamento){
			$this->data_lancamento = $data_lancamento;
		}

		public function getData_Lancamento(){
			return $this->data_lancamento;
		}

		public function setFotos($fotos){
			$this->fotos = $fotos;
		}

		public function getFotos(){
			return $this->fotos;
		}

		public function setGenero($genero){
			$this->genero = $genero;
		}

		public function getGenero(){
			return $this->genero;
		}
	}
?>