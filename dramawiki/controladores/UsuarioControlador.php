<?php

	require_once "../DAOs/UsuarioDAO.php";
	require_once "../utils/conexao.php";

	class UsuarioControlador{

		static function salvar($usuario){

			try{
				$conexao = Conexao::criarConexao();
				$usuarioDAO = new UsuarioDAO();
				$usuarioDAO->salvar($usuario,$conexao);
				
			}catch(PDOException $erro){
				throw $erro;
			}finally{
				Conexao::fecharConexao();
			}
		}

		static function autenticar($usuario){

            try{
				$conexao = Conexao::criarConexao();
				$usuarioDAO = new UsuarioDAO();
                return $usuarioDAO->autenticar($usuario,$conexao);
            }catch(PDOException $erro){
                throw $erro;
            }finally{
				Conexao::fecharConexao();
			}
		}
	}
?>