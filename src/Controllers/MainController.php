<?php

    class MainController
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

    }

?>