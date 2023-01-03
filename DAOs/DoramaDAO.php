<?php

	require_once "FotoDAO.php";

	class DoramaDAO{
		
		public function salvar($dorama,$conexao){
			try {

				$sql = "INSERT INTO doramas(titulo,data_lancamento,sinopse,id_generos) VALUES (?,?,?,?)";
				$stmt = $conexao->prepare($sql);
				$stmt->bindvalue(1,$dorama->getTitulo());
				$stmt->bindvalue(2,$dorama->getData_Lancamento());
				$stmt->bindvalue(3,$dorama->getSinopse());
				$stmt->bindvalue(4,$dorama->getGenero()->getId());
				$stmt->execute();
				$id = $conexao->lastInsertId();
                $dorama->setId($id);

				$fotoDAO = new FotoDAO();
                for($i=0;$i<count($dorama->getFotos());$i++){

                    $foto = $dorama->getFotos()[$i];
                    $foto->setDorama($dorama);
                    $fotoDAO->salvar($foto,$conexao);
                }
                return $dorama;
			} catch (PDOException $erro) {
				throw $erro;
					
			}
		}

		public function excluir($dorama, $conexao){
			try {
				$sql = "DELETE FROM doramas WHERE id= ?";
				$stmt = $conexao->prepare($sql);
				$stmt->bindvalue(1,$dorama->getId());
                $stmt->execute();

			} catch (PDOException $erro) {
				throw $erro;
					
			}

		}

		public function buscar($conexao){

			try {

				$sql = "SELECT id, titulo, data_lancamento, sinopse, id_generos FROM doramas";
				$stmt = $conexao->prepare($sql);
				$stmt->execute();
				$listaDeDoramas = [];

				while($doramaBD = $stmt->fetch(PDO::FETCH_OBJ)){
					$dorama = new Dorama();
					$dorama->setId($doramaBD->id);
					$dorama->setTitulo($doramaBD->titulo);
					$dorama->setData_Lancamento($doramaBD->data_lancamento);
					$dorama->setSinopse($doramaBD->sinopse);
					$id_genero = $doramaBD->id_generos;
					$generoDAO = new GeneroDAO();
					$genero = $generoDAO->buscarPeloId($id_genero, $conexao);
					$dorama->setGenero($genero);
					$fotoDAO = new FotoDAO();
		            $fotos = $fotoDAO->buscarPeloIdDorama($dorama->getId(),$conexao);
		            $dorama->setFotos($fotos);
					array_push($listaDeDoramas, $dorama);
					echo "<br>";

				}
				return $listaDeDoramas;

			} catch (PDOException $erro) {
				echo $erro->getMessage();
					
			}
		}

		public function buscarPeloId($id,$conexao){
        	
        	try {
	        	$sql = "SELECT * FROM doramas WHERE id = ?";
	        	$stmt = $conexao->prepare($sql);
	        	$stmt->bindvalue(1,$id);
	        	$stmt->execute();
				$doramaBD = $stmt->fetch(PDO::FETCH_OBJ);
				$dorama = new Dorama();
				$dorama->setId($doramaBD->id);
				$dorama->setTitulo($doramaBD->titulo);
				$dorama->setData_Lancamento($doramaBD->data_lancamento);
				$dorama->setSinopse($doramaBD->sinopse);
				$id_genero = $doramaBD->id_generos;
				$generoDAO = new GeneroDAO();
				$genero = $generoDAO->buscarPeloId($id_genero, $conexao);
				$dorama->setGenero($genero);
				$fotoDAO = new FotoDAO();
	            $fotos = $fotoDAO->buscarPeloIdDorama($dorama->getId(),$conexao);
	            $dorama->setFotos($fotos);

				return $dorama;

			} catch (PDOException $erro){
				echo $erro->getMessage();	
			}
        }

	}

?>