<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard | Painel Admin</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="../css/boot.css">

    </head>
    <body class="bg-light">

        <!--CABEÇALHO-->
        <header>

            <div class="barra-topo bg-black container">

                <div class="content">

                    <!--PERFIL-->
                    <div class="barra-topo-perfil">
                        <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/foto-recados.png" />
                        <h1>Luiz Felipe</h1>
                    </div>
                    <!--PERFIL-->

                    <!--MENU NAV-->
                    <nav class="main_nav">
                        <div class="j_close close_nav fl-right">X</div>
                        <ul class="menu">
                            <li class="menu-dashboard"><a class="shorticon shorticon-dashboard-menu" title="Dashboard" href="" >Dashboard</a></li>
                            <li id="submenu_posts" class="sub"><a class="shorticon shorticon-posts" title="Posts" href="" >Posts</a>
                                <ul class="submenu">
                                    <li><a title="Novo Post" href="#">>> Ver Post</a></li>
                                    <li><a title="Novo Post" href="#">>> Novo Post</a></li>
                                    <li><a title="Novo Post" href="#">>> Categorias</a></li>
                                </ul>
                            </li>
                            <li><a class="shorticon shorticon-produtos" title="Produtos" href="" >Produtos</a></li>
                            <li><a class="shorticon shorticon-pedidos-menu" title="Pedidos" href="" >Pedidos</a></li>
                            <li><a class="shorticon shorticon-imoveis" title="Imóveis" href="" >Imóveis</a>
                            <ul class="submenu">
                                <li><a class="al-left fl-left" title="Novo Post" href="#">>> Ver Imóveis</a></li>
                                    <li><a class="al-left fl-left" title="Novo Post" href="#">>> Novo Imóvel</a></li>
                                </ul>
                            </li>
                            <li><a class="shorticon shorticon-comentarios-menu" title="Comentários" href="" >Comentários</a></li>
                            <li><a class="shorticon shorticon-destaque" title="Em Destaque" href="" >Em destaque</a></li>
                            <li><a class="shorticon shorticon-paginas" title="Páginas" href="" >Páginas</a></li>
                            <li id="submenu_usuarios" class="sub"><a class="shorticon shorticon-usuarios-menu" title="Usuários" href="" >Usuários</a>
                                <ul class="submenu">
                                    <li><a title="Novo Post" href="#">>> Ver Usuários</a></li>
                                    <li><a title="Novo Post" href="#">>> Clientes</a></li>
                                    <li><a title="Novo Post" href="#">>> Equipe</a></li>
                                    <li><a title="Novo Post" href="#">>> Novo Usuário</a></li>
                                </ul>
                            </li>
                            <li><a class="shorticon shorticon-config" title="Configurações" href="" >Configurações</a></li>
                            <li><a class="shorticon shorticon-ver-site" target="_blank" title="Ver Site" href="" >Ver Site</a></li>
                        </ul>
                    </nav>
                    <!--MENU NAV-->

                    <!--MENU MOBILE-->
                    <div class="barra-topo-menu-mobile j_menu_mobile">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <!--MENU MOBILE-->

                    <div class="clear"></div>
                </div>


            </div>

            <div class="container pre-titulo">
                <div class="content">
                    <!--BOAS VINDAS-->
                    <p class="bem-vindo">Bem-vindo(a) ao Admin Panel, Hoje 16/11/16 12:07</p>
                    <!--BOAS VINDAS-->

                    <!--SAIR-->
                    <a class="sair shorticon shorticon-botao-sair btn btn-red radius" title="" href="" >Sair!</a>
                    <!--SAIR-->

                    <div class="clear"></div>
                </div>
            </div>


        </header>
        <!--CABEÇALHO-->


        <main>
