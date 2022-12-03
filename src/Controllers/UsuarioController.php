<?php

require_once "../Data/Conexao.php";
require_once "../Models/Endereco/EnderecoDAO.class.php";
require_once "../Models/Usuario/Usuario.class.php";
require_once "../Models/Usuario/UsuarioDAO.class.php";

class UsuarioController extends MainController
{
    public function Login($email, $senha)
    {
        if($_POST)
        {
            parent::IniciarSessionStorage();

            $usuarioDAO = new UsuarioDAO();

            $result = $usuarioDAO->ObterUsuarioPorEmailSenha($email, $senha);

            if(is_array($result) && count($result) > 0)
            {
                $_SESSION["codigo"] = $result[0]->codigo;
                $_SESSION["nome"] = $result[0]->nome;
                $_SESSION["tipo_usuario"] = $result[0]->tipo_usuario;

                header("location:../index.php");
            }

            else
            {
                echo "<script>alert('Email ou senha incorretos.')</script>";
            }
        }
    }

    public function Logout()
    {
        parent::IniciarSessionStorage();
        $_SESSION = array(); 
        session_destroy(); 

        header("location:../Views/index.php");
    }

    public function CadastrarUsuario(Usuario $usuario)
    {
        $erros = $this->ValidarUsuario($usuario);

        if(count($erros) > 0)
        {
            $mensagem = "";

            foreach($erros as $erro)
            {
                $mensagem += "$erro <br>";
            }

            echo "<script>alert('$mensagem')</script>";
        }

        else
        {
            $usuarioDAO = new UsuarioDAO();
            $enderecoDAO = new EnderecoDAO();

            $enderecoDAO->AdicionarEndereco($usuario->getEndereco());

            $endereco = $enderecoDAO->ObterEnderecoPorLogradouroNumeroBairro($usuario->getEndereco()->getLogradouro(),
                        $usuario->getEndereco()->getNumero(), $usuario->getEndereco()->getBairro());

            if(is_array($endereco) && count($endereco) > 0)
                $usuario->getEndereco()->setCodigo($endereco[0]->codigo);

            $usuarioDAO->AdicionarUsuario($usuario);

            $this->Login($usuario->getEmail(), $usuario->getSenha());
        }        

    }

    public function ValidarUsuario(Usuario $usuario)
    {
        $erros = array();

        if(trim($usuario->getNome()) == "")
        {
            $erros[] = "Nome não pode estar vazio.";
        }

        if(trim($usuario->getEmail()) == "")
        {
            $erros[] = "Email não pode estar vazio.";
        }

        if(trim($usuario->getSenha()) == "")
        {
            $erros[] = "Senha não pode estar vazia.";
        }

        if(trim($usuario->getEndereco()->getLogradouro()) == "")
        {
            $erros[] = "Rua não pode estar vazio.";
        }

        if(trim($usuario->getEndereco()->getBairro()) == "")
        {
            $erros[] = "Bairro não pode estar vazio.";
        }

        if(trim($usuario->getEndereco()->getCidade()) == "")
        {
            $erros[] = "Cidade não pode estar vazia.";
        }

        if(trim($usuario->getEndereco()->getCep()) == "")
        {
            $erros[] = "CEP não pode estar vazio.";
        }

        if(trim($usuario->getEndereco()->getUf()) == "")
        {
            $erros[] = "UF não pode estar vazio.";
        }

        return $erros;
    }
}

?>