<?php

    require_once "../modelos/Genero.php";
    include "../utils/controleDeAcesso.php";

    $listaDeGeneros = $_SESSION['listaDeGeneros'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DramaWiki - Doramas</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<ul>
        <li><a>DramaWiki ADM</a></li>
        <li style="float:right"><a href='../controladores/rota.php?acao=logout'>Logout</a></li>
        <li style="float:right"><a href='../controladores/rota.php?acao=formCadastrarDorama'>Cadastrar</a></li>
        <li style="float:right"><a href='../controladores/rota.php?acao=verDoramas'>Excluir Doramas</a></li>
    </ul>
	<div>
		<form enctype="multipart/form-data" action="../controladores/rota.php?acao=salvarDorama" method="POST">
			<h1>CADASTRAR DORAMAS</h1><br>
			<label>Título:</label><br>
			<input type="text" name="titulo" required><br>
			<label>Sinopse:</label><br>
			<input type="text" name="sinopse" required><br>
			<label>Data de Lançamento:</label><br>
			<input type="date" name="data_lancamento" required><br>
			<select name="genero">
	        	<?php
	            	foreach($listaDeGeneros as $genero){
	            		echo "<option value='{$genero->getId()}'>{$genero->getNome()}</option>";
	    	       	}
	        	?>
	    	</select><br>
			<label>Fotos:</label>
	    	<input type="file" name="fotos[]" multiple> <br>
			<!--	<label>Arquivo do Banner:</label>
				<input type="file" name="banner[]" required><br><br>
			-->	
			<button>Salvar informações</button>
		</form>
	</div>
</body>
</html>