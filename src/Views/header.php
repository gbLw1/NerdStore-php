<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-4">
                    <a class="brand-wrap" href="index.php">
                        <img src="img/logo.png" alt="logo">
                    </a>
                </div>
                <div class="col-lg-5 col-sm-12 pt-2">
                    <form method="get" class="search" action="/showcase">
                        <div class="input-group w-100">
                            <input type="text" id="q" name="q" class="form-control" placeholder="Pesquisar">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex justify-content-end">
                        <?php
                        require_once "../Controllers/MainController.php";
                        require_once "../Controllers/CarrinhoController.php";

                        $carrinhoController = new CarrinhoController();

                        $usuarioAutenticado = $carrinhoController->UsuarioEstaAutenticado();

                        if ($usuarioAutenticado)
                        {
                            echo "<div class='widget-header'>
                                            <small class='title text-muted'>Bem Vindo!</small>
                                            <div>
                                                <a href='cadastro-usuario.php'>Pedidos</a> <span> | </span>
                                                <a href='carrinho.php'> Carrinho ({$carrinhoController->ObterCarrinhoItensQuantidade($_SESSION["codigo"])})</a> <span> | </span>
                                                <a href='logout.php'> Logout</a>
                                            </div>
                                        </div>";
                        }
                        else
                        {
                            echo "<div class='widget-header'>
                                            <small class='title text-muted'>Bem Vindo!</small>
                                            <div>
                                                <a href='cadastro-usuario.php'>Criar Conta</a> <span> | </span>
                                                <a href='login.php'> Login</a>
                                            </div>
                                        </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>