<?php

	require_once '../modelos/Dorama.php';
	require_once 'DoramaControlador.php';
	require_once '../modelos/Usuario.php';
	require_once 'UsuarioControlador.php';
	require_once '../modelos/Favoritos.php';
	require_once '../modelos/Foto.php';
	require_once 'GeneroControlador.php';
	require_once '../modelos/Genero.php';

	$acao = $_GET['acao'];

	switch ($acao) {

		case 'formCadastrarUsuario':
			
			header('Location: ../views/formCadastrarUsuario.html');

			break;

		case 'formLoginUsuario':
			
			header('Location: ../views/index.html');	

			break;
	
		case 'salvarUsuario':

			$nome_completo = $_POST['nome_completo'];
			$telefone = $_POST['telefone']; 
			$email = $_POST['email'];
			$nome_usuario = $_POST['nome_usuario'];
			$senha = $_POST['senha'];
	
			$usuario = new Usuario();
			$usuario->setNome_Completo($nome_completo);
			$usuario->setNome_Usuario($nome_usuario);
			$usuario->setTelefone($telefone);
			$usuario->setEmail($email);
			$usuario->setSenha($senha);			
		
			try{
				UsuarioControlador::salvar($usuario);
				header('Location: ../views/index.html');	
			}catch(PDOException $erro){
				echo $erro;
			}

			break;

		case 'entrarUsuario':

			$email = $_POST['email'];
            $senha = $_POST['senha'];
            $usuario = new Usuario();
            $usuario->setEmail($email);
            $usuario->setSenha($senha);
            echo "oi";
			
			try{
				$usuario = UsuarioControlador::autenticar($usuario);
				
				if(!$usuario){
					header('Location: ../views/index.html');
				}else{
					session_start();
					$_SESSION['usuario'] = $usuario;
					if($usuario->getStatus() == 1){
						$listaDeGeneros = GeneroControlador::buscarTodosGeneros();
			            $_SESSION['listaDeGeneros'] = $listaDeGeneros;
						header('Location: ../views/formCadastrarDorama.php'); 
					}else{
						$listaDeDoramas = DoramaControlador::buscar();
						session_start();
						$_SESSION['listaDeDoramas'] = $listaDeDoramas;
						header('Location: ../views/mostrarDoramas.php');
					}
				}
 
			}catch(PDOException $erro){
				echo $erro;
			}
			
			break;

		case 'formCadastrarDorama':

			$listaDeGeneros = GeneroControlador::buscarTodosGeneros();
            session_start();
            $_SESSION['listaDeGeneros'] = $listaDeGeneros;
			
			header('Location: ../views/formCadastrarDorama.php');

			break;

		case 'salvarDorama':

			$titulo = $_POST['titulo'];
			$sinopse = $_POST['sinopse'];
			$data_lancamento = $_POST['data_lancamento'];
			$id_genero = $_POST['genero'];
			$numeroImagens = count($_FILES["fotos"]["name"]);
                
            $fotos = [];

            for($i=0;$i<$numeroImagens;$i++){

            	$foto = new Foto();
            	$foto->setNome($_FILES["fotos"]["name"][$i]);
                $foto->setTipo($_FILES["fotos"]["type"][$i]);
                $tamanho = $_FILES["fotos"]["size"][$i];

                //manipular o aquivo
                $arquivo = $_FILES["fotos"]["tmp_name"][$i]; 
                $fp = fopen($arquivo, "rb");
                $conteudo = fread($fp, $tamanho);
                //$conteudo = addslashes($conteudo);
                fclose($fp);     

                $foto->setArquivo($conteudo);
                //
				array_push($fotos,$foto);
			}
			$genero = new Genero();
			$genero->setId($id_genero);
			$dorama = new Dorama();
			$dorama->setTitulo($titulo);
			$dorama->setSinopse($sinopse); 
			$dorama->setData_Lancamento($data_lancamento);
			$dorama->setGenero($genero);
            $dorama->setFotos($fotos);

			try{

				DoramaControlador::salvar($dorama);
				header('Location: ../views/formCadastrarDorama.php');

			}catch(PDOException $erro){
				echo $erro->getMessage();
			}

			break;


		case 'verDoramas':


			$listaDeDoramas = DoramaControlador::buscar();
			session_start();
			$_SESSION['listaDeDoramas'] = $listaDeDoramas;	
			header('Location: ../views/mostrarDoramas.php');

			break;

		case 'excluirDorama':

			session_start();
			$id = $_GET['id'];

			$dorama = new Dorama();
			$dorama->setId($id);		
			try{
				DoramaControlador::excluir($dorama);
				header('Location:../views/mostrarDoramas.php'); 
			}catch(PDOException $erro){
				echo $erro->getMessage();

			}

			break;

		case 'favoritar':

			session_start();
			$usuario = $_SESSION['usuario'];
			$id_dorama = $_GET['id'];

			$favorito = new Favoritos();
			$favorito->setId_Dorama($id_dorama);
			$favorito->setId_Usuario($usuario->getId());
			
			try{
				DoramaControlador::favoritar($favorito);
				header('Location:../views/mostrarDoramas.php'); 
			}catch(PDOException $erro){
				echo $erro->getMessage();

			}

		break;

		case 'verFavoritos':
			#ainda preciso arrumar
			session_start();

			$usuario = $_SESSION['usuario'];

			$favoritos = new Favoritos();
			$favoritos->setId_Usuario($usuario->getId());
			
			$listaDeDoramas = DoramaControlador::verFavoritos($favoritos);
			$_SESSION['listaDeDoramas'] = $listaDeDoramas;
			header('Location: ../views/mostrarFavoritos.php');

			break;

		case 'excluirFav':

			session_start();
			$usuario = $_SESSION['usuario'];
			$id_dorama = $_GET['id'];

			$favoritos = new Favoritos();
			$favoritos->setId_Dorama($id_dorama);
			$favoritos->setId_Usuario($usuario->getId());
			
			try{
				DoramaControlador::excluirFavorito($favoritos);
				header('Location:../views/mostrarDoramas.php'); 
			}catch(PDOException $erro){
				echo $erro->getMessage();

			}

		break;

		case "logout":
            session_start();
            session_destroy();
            header('Location: ../views/index.html');
            exit();
            break;

	}

?>