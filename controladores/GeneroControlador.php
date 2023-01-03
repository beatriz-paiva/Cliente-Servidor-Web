<?php

	require_once '../DAOs/GeneroDAO.php';
	require_once '../utils/conexao.php';


	class GeneroControlador{

		static function buscarTodosGeneros(){

			try {
				
				$conexao = Conexao::criarConexao();
				$generoDAO = new generoDAO();
				$listaDeGeneros = $generoDAO->buscarTodosGeneros($conexao);
				return $listaDeGeneros;

			} catch (Exception $erro) {
				throw $erro;
			}finally{
				Conexao::fecharConexao();
			}
		}

		static function buscarPeloId($id){

			try {
				
				$conexao = Conexao::criarConexao();
				$generoDAO = new generoDAO();
				$genero = $generoDAO->buscarPeloId($id,$conexao);
				return $genero;

			} catch (Exception $erro) {
				throw $erro;
			}finally{
				Conexao::fecharConexao();
			}

		}

	}

?>