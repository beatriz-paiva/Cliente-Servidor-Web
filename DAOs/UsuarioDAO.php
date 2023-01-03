<?php

	class UsuarioDAO{
		
		public function salvar($usuario,$conexao){

			try {

				$sql = "INSERT INTO usuarios(nome_completo,nome_usuario,telefone,email,senha) VALUES (?,?,?,?,?)";
				$stmt = $conexao->prepare($sql);
				$stmt->bindvalue(1,$usuario->getNome_Completo());
				$stmt->bindvalue(2,$usuario->getNome_Usuario());
				$stmt->bindvalue(3,$usuario->getTelefone());
				$stmt->bindvalue(4,$usuario->getEmail());
				//$hash = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
				$stmt->bindValue(5,password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
				//$stmt->bindvalue(5,$hash);
				$stmt->execute();
			} catch (PDOException $erro) {
				throw $erro;
					
			}
			
			
		}

		public function autenticar($usuario,$conexao){
			
			try {

                $sql = "SELECT * FROM usuarios WHERE email = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bindValue(1,$usuario->getEmail());
                $stmt->execute();

                $usuarioBD = $stmt->fetch(PDO::FETCH_OBJ);
				
                if(password_verify($usuario->getSenha(), $usuarioBD->senha)){
					$usuario->setId($usuarioBD->id);
					$usuario->setStatus($usuarioBD->status);
                	return $usuario;

                }else{
                    return false;

                }  
            } catch (PDOException $erro) {
                echo $erro->getMessage();
            }
		}
	}

	





?>