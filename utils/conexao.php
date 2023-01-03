<?php

    class Conexao{

        static private $usuario = "root";
        static private $senha = "";
        static private $banco = "dramawiki";
        static private $host = "localhost";

        static private $conexao;
        
        static function criarConexao(){
            try{
                self::$conexao = new PDO("mysql:host=".self::$host.";dbname=".self::$banco, self::$usuario, self::$senha);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $erro){
                throw $erro;
            }
            return self::$conexao;
        }

        static function fecharConexao(){
            self::$conexao = null;
        }

    }