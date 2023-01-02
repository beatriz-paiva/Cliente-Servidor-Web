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

	}


?>