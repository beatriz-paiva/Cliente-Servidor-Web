<?php

	require_once "../modelos/Genero.php";

	class GeneroDAO{


		function buscarTodosGeneros($conexao){

			try {
				
				$sql = "SELECT * FROM generos";
				$stmt = $conexao->prepare($sql);
				$stmt->execute();
				$listaDeGeneros = [];
				while ($generoBD = $stmt->fetch(PDO::FETCH_OBJ)) {
					$genero = new Genero();
					$genero->setId($generoBD->id);
					$genero->setNome($generoBD->nome);
					array_push($listaDeGeneros, $genero);
				}
				return $listaDeGeneros;
			} catch (PDOException $erro) {
				throw $erro;
			}
		}

		function buscarPeloId($id,$conexao){

			try {
				
				$sql = "SELECT * FROM generos WHERE id = ?";
				$stmt = $conexao->prepare($sql);
	        	$stmt->bindvalue(1,$id);
	        	$stmt->execute();
				$generoBD = $stmt->fetch(PDO::FETCH_OBJ);
				$genero = new Genero();
				$genero->setId($generoBD->id);
				$genero->setNome($generoBD->nome);

				return $genero;
			} catch (PDOException $erro) {
				throw $erro;
			}
		}

	}


?>