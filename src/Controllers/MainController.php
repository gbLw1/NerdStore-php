<?php

    require_once realpath(dirname(__FILE__)) . "/../Models/Conexao.php";
    class MainController extends Conexao
    {
        public function IniciarSessionStorage()
        {
            if(!isset($_SESSION))
                session_start();
        }

        public function UsuarioEstaAutenticado()
        {
            if(!isset($_SESSION))
                session_start();

            if(isset($_SESSION["codigo"]))
                return true;

            else
                return false;
        }

        public function UsuarioAdm()
        {
            $tipoUsuario = $_SESSION["tipo_usuario"];
            if ($tipoUsuario != 2)
            {
                return false;
            }
            else
            {
                return true;
            }
        }

    }

?>