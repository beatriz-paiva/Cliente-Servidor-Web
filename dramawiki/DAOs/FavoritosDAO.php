<?php

    class FavoritosDAO{

        public function favoritar($favorito,$conexao){

            try {

				$sql = "INSERT INTO favoritos(id_usuario,id_dorama) VALUES (?,?)";
				$stmt = $conexao->prepare($sql);
				$stmt->bindvalue(1,$favorito->getId_Usuario());
				$stmt->bindvalue(2,$favorito->getId_Dorama());
                $stmt->execute();

			} catch (PDOException $erro) {
				throw $erro;
					
			}

        }

        public function excluirFavorito($favorito,$conexao){
			
			try {
				#DELETE FROM `favoritos` WHERE `id_usuario` = 12 AND `id_dorama` = 1;
				$sql = "DELETE FROM favoritos WHERE id_usuario = ? AND id_dorama = ?";
				$stmt = $conexao->prepare($sql);
				$stmt->bindvalue(1,$favorito->getId_Usuario());
				$stmt->bindvalue(2,$favorito->getId_Dorama());
                $stmt->execute();

			} catch (PDOException $erro) {
				throw $erro;
					
			}


        }

        public function buscarIdFavoritos($favoritos,$conexao){

        	$sql = "SELECT * FROM favoritos WHERE id_usuario = ?";
        	$stmt = $conexao->prepare($sql);
        	$stmt->bindvalue(1,$favoritos->getId_Usuario());
        	$stmt->execute();
			
			$listaDeIdFavoritos = [];

        	while($favoritoBD = $stmt->fetch(PDO::FETCH_OBJ)){
				$favoritos = new Favoritos();
				$favoritos->setId($favoritoBD->id);
				$favoritos->setId_Usuario($favoritoBD->id_usuario);
				$favoritos->setId_Dorama($favoritoBD->id_dorama);
				array_push($listaDeIdFavoritos, $favoritos);
				echo "<br>";
			}

			return $listaDeIdFavoritos;
        }


    }

?>