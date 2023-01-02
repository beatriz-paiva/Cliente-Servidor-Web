<?php

    class FotoDAO{

        function salvar($foto,$conexao){

            try{
                
                $sql = "INSERT INTO fotos(nome,tipo,arquivo,id_doramas) VALUES (?,?,?,?)";
                $stmt = $conexao->prepare($sql);
                $stmt->bindValue(1,$foto->getNome());
                $stmt->bindValue(2,$foto->getTipo());
                $stmt->bindValue(3,$foto->getArquivo());               
                $stmt->bindValue(4,$foto->getDorama()->getId());
                $stmt->execute();

            }catch(PDOException $erro){
                throw $erro;
            }
        }
        function buscarPeloIdDorama($id,$conexao){

            try{

                
                $sql = "SELECT * FROM fotos WHERE id_doramas = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bindValue(1,$id);
                $stmt->execute();
                $listaDeFotos = [];
                
                while($fotoBanco = $stmt->fetch(PDO::FETCH_OBJ)){
                    $foto = new Foto();
                    $foto->setId($fotoBanco->id);
                    $foto->setNome($fotoBanco->nome);
                    $foto->setTipo($fotoBanco->tipo);
                    $foto->setArquivo(base64_encode($fotoBanco->arquivo));                                        
                    array_push($listaDeFotos,$foto);
                }
                return $listaDeFotos;
            }catch(PDOException $erro){
                throw $erro;
            }
        }
    }
?>