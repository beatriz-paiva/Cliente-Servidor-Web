<?php
    require_once "../modelos/Dorama.php";
    require_once "../modelos/Foto.php";
    require_once "../modelos/Genero.php";
    include "../utils/controleDeAcesso.php";

    $listaDeDoramas = $_SESSION['listaDeDoramas'];

    echo "<div style='padding:20px;margin-top:30px;'>";

    foreach($listaDeDoramas as $dorama){

        echo "<div class='gallery'>";
        $genero = $dorama->getGenero();
            echo "<h3>{$dorama->getTitulo()}</h3><p>{$dorama->getSinopse()}</p><br><b>{$genero->getNome()}</b> <i>{$dorama->getData_Lancamento()}</i>";      
        $fotos = $dorama->getFotos();
        foreach($fotos as $foto){          
            echo '<img src = "data:image/png;base64,' . $foto->getArquivo() . '" width = "50px" height = "50px"/>';
        }
        echo "
        <td><a href='../controladores/rota.php?id={$dorama->getId()}&acao=excluirFav'>Excluir</a></td>  
        </div>";
        
    }
    echo "</div>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DramaWiki</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <ul>
        <li><a>DramaWiki</a></li>
        <li><a href='../controladores/rota.php?acao=verDoramas'>Dramas</a></li>
        <li style="float:right"><a href='../controladores/rota.php?acao=logout'>Logout</a></li>
        <li style="float:right"><a href='../controladores/rota.php?acao=verFavoritos'>Favoritos</a></li>
    </ul>
</body>
</html>