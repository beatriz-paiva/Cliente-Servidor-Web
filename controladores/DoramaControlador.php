<?php

	require_once "../DAOs/DoramaDAO.php";
	require_once "../DAOs/FavoritosDAO.php";

	class DoramaControlador{

		static function salvar($dorama){
			try{
				$conexao = Conexao::criarConexao();
				$doramaDAO = new DoramaDAO();
				$doramaDAO->salvar($dorama,$conexao);
			}catch(PDOException $erro){
				throw $erro;
			}finally{
				Conexao::fecharConexao();
			}
		}

		static function excluir($dorama){

			try{
				$conexao = Conexao::criarConexao();
				$doramaDAO = new DoramaDAO();
				$doramaDAO->excluir($dorama,$conexao);
				
			}catch(PDOException $erro){
				echo $erro->getMessage();
			}finally{
				Conexao::fecharConexao();
			}

		}

		static function buscar(){
			
			try{
				$conexao = Conexao::criarConexao();
				$doramaDAO = new DoramaDAO();
				$listaDeDoramas = $doramaDAO->buscar($conexao);
				return $listaDeDoramas;
				
			}catch(PDOException $erro){
				echo $erro->getMessage();
			}finally{
				Conexao::fecharConexao();
			}
			
		}

		static function favoritar($favorito){

			try{
				$conexao = Conexao::criarConexao();
				$favoritosDAO = new FavoritosDAO();
				$favoritosDAO->favoritar($favorito,$conexao);
				
			}catch(PDOException $erro){
				echo $erro->getMessage();
			}finally{
				Conexao::fecharConexao();
			}

		}

		static function excluirFavorito($favorito){

			try{
				$conexao = Conexao::criarConexao();
				$favoritosDAO = new FavoritosDAO();
				$favoritosDAO->excluirFavorito($favorito,$conexao);
				
			}catch(PDOException $erro){
				echo $erro->getMessage();
			}finally{
				Conexao::fecharConexao();
			}

		}

		static function verFavoritos($favoritos){

			try{
				$conexao = Conexao::criarConexao();
				$favoritosDAO = new FavoritosDAO();
				$listaDeFavoritos = $favoritosDAO->buscarIdFavoritos($favoritos, $conexao);
				print_r($listaDeFavoritos);
				$doramaDAO = new DoramaDAO();
				//$id = (object) $listaDeIdFavoritos;
				$listaDeDoramas = [];
				for($i=0;$i<count($listaDeFavoritos);$i++){
					$doramas = $doramaDAO->buscarPeloId($listaDeFavoritos[$i]->getId_Dorama(),$conexao);
					echo $listaDeFavoritos[$i]->getId_Dorama();
					array_push($listaDeDoramas, $doramas);
				}
				return $listaDeDoramas;
			}catch(PDOException $erro){
				echo $erro->getMessage();
			}finally{
				Conexao::fecharConexao();
			}
			
		}

	}