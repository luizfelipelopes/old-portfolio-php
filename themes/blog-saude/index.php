<div class="bloco_slide main_slides container">
    <?php
    if (!empty($_SESSION['theme'])):
        include '_cdn/app_slides/slides-fotos-demo.inc.php';
    else:
        include '_cdn/app_slides/slides-fotos.inc.php';
    endif;
    ?>
</div>

<section class="container m-bottom3 dobra1">
    <div class="content">
        <header class="sectiontitle titulo_dobra1">
            <h1>Bem Vindo à Excelência em Emagrecimento Definitivo!</h1>
        </header>

        <article class="container">
            <div class="content">
<!--                <p>
                    Mussum Ipsum, cacilds vidis litro abertis. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Interagi no
                    mé, cursus quis, vehicula ac nisi. Per aumento de cachacis, eu reclamis. A ordem dos tratores não altera o pão duris. Mussum
                    Ipsum, cacilds vidis litro abertis. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Interagi no mé,
                    cursus quis, vehicula ac nisi. Per aumento de cachacis, eu reclamis. A ordem dos tratores não altera o pão duris.
                </p>
                <p>
                    Mussum Ipsum, cacilds vidis litro abertis. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Interagi no
                    mé, cursus quis, vehicula ac nisi. Per aumento de cachacis, eu reclamis. A ordem dos tratores não altera o pão duris. Mussum
                    Ipsum, cacilds vidis litro abertis. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Interagi no mé,
                    cursus quis, vehicula ac nisi. Per aumento de cachacis, eu reclamis. A ordem dos tratores não altera o pão duris.
                </p>-->

                <p>Bem vinda a sua casa de Nutrição e Coach de Emagrecimento Online. Aqui você encontrará dicas e conselhos sobre Emagrecimento Saudável, Comidas, Exercícios, Mente, Autoestima e Saúde em Geral. Fique a vontade, a casa é sua e o Amor é nosso!</p>
                <p>Somos certificados pela Federal de Diamantina (UFVJM) e por uma das melhores escolas de Coach Nutricional do mundo, o Instituto Health Coaching, que possui certificação Nacional e Internacional.</p>
                <p>Possuímos uma metodologia diferenciada e eficaz, que tem um poder transformador incrível, melhorando desde a sua mente até as suas atitudes. As mudanças são da alimentação até o seu estilo de vida completo, sem sofrimento exagerado ou dor por estar perdendo algo que gosta. Aqui você aprende a ganhar, ganhar mais alegria, mais autoestima, mais qualidade de vida e principalmente ganhar a sua melhor versão.</p>
                <p>Sabemos que as mudanças de hábitos e de estilo de vida são a chave para acabar com o efeito sanfona que não te deixa sair do lugar. Mas isso não acontece de uma hora pra outra, é preciso entender quais as suas necessidades, qualidades e dificuldades, pois cada um é um ser individual e somente quando trabalhamos passo a passo com você é que conseguimos te ajudar da maneira mais confortável e definitiva.</p>
                <p>Não deixe pra depois, pois com a grande procura as vagas estão limitadas! Clique no botão abaixo e comece a sua mudança hoje!</p>

                <div class="al-center m-top3">
                    <a title="Ganhe Uma Sessão Gratuita!" href="<?= HOME . DIRECTORY_SEPARATOR . 'treinamentoreal' . '/&theme=' . THEME; ?>" class="btn btn-green radius">Ganhe Uma Sessão Gratuita!</a>
                </div>

                <div class="clear"></div>
            </div>
        </article>
        <div class="clear"></div>
    </div>

</section>


<section class="container dobra2 m-bottom3">
    <header class="sectiontitle titulo_dobra2 pd-top3 pd-bottom3">
        <div class="content">
            <h1>Veja Aqui Como Sua Vida Pode Mudar</h1>
            <div class="clear"></div>
        </div>
    </header>

    <div class="content">
        <div class="flex container">
            <article class="flex-3">
                <div class="content">
                    <header class="container m-bottom1">
                        <h1>Pra Quem é o Nosso Trabalho?</h1>
                    </header>

                    <p>Nossos programas são direcionados para você que quer ter mais saúde, ter o peso ideal, que de alguma forma, já tentou cuidar da sua saúde, já tentou emagrecer, seguir dietas, fazer alguma atividade física, mas ainda não conseguiu e precisa de resultados, pois está cansada de tentar e achar que não consegue.</p>

                    <div class="clear"></div>
                </div>
            </article>
            <article class="flex-3">
                <div class="content">
                    <header class="container m-bottom1">
                        <h1>Como faço para começar</h1>
                    </header>

                    <p>Para você que precisa muito emagrecer imediatamente e quer conhecer na prática como nosso trabalho funciona, decidimos fazer uma promoção esse mês e te presentear com a primeira sessão do tratamento GRATUITA. Nela você já começará seu processo de transformação que promoverá o autoconhecimento e a identificação das suas melhores qualidades, aquelas que vão te ajudar a chegar nos seus objetivos, para assim, podermos direcionar o melhorar tratamento para você.</p>

                    <div class="clear"></div>
                </div>
            </article>
            <article class="flex-3">
                <div class="content">
                    <header class="container m-bottom1">
                        <h1>O que eu posso ganhar?</h1>
                    </header>

                    <p>O seu ganho pode ser gigantesco e até incalculável, pois a sua alegria e bem-estar não tem preço. Os resultados descritos por quem já fez o acompanhamento Online são vários, mas o que elas mais dizem que ganharam foi qualidade de vida, que além de melhorar o peso e a saúde física, conseguiram se entender e melhorar a cabeça, sendo mais felizes. Afinal, quanto vale a sua alegria, seu bem-estar e a sua autoestima? Tenho certeza que vale muito mais do que consegue descrever agora!</p>

                    <div class="clear"></div>
                </div>
            </article>

        </div>
        <div class="clear"></div>
    </div>

</section>

<section class="container dobra3 m-bottom3">
    <header class="sectiontitle titulo_dobra3 container pd-top3 pd-bottom3">
        <div class="content">
            <h1>O Que Elas Falam Sobre a Nutri</h1>
            <div class="clear"></div>
        </div>
    </header>

    <div class="content al-center">

        <div class="flex container al-center">

            <?php
            if (!empty($_SESSION['theme'])):

                $ArrayVideos = [
                    [
                        "depoimento_video" => "OlinRlqOzEQ",
                        "depoimento_name" => "Dayane Meneguele",
                        "depoimento_cidade" => "Itapetininga - SP",
                    ],
                    [
                        "depoimento_video" => "oQ4iSFMlj-8",
                        "depoimento_name" => "Elizângela",
                        "depoimento_cidade" => "Itapetininga - SP",
                    ],
                    [
                        "depoimento_video" => "ysFdDz5IMn4",
                        "depoimento_name" => "Franciele Martins",
                        "depoimento_cidade" => "Belo Horizonte - MG",
                    ]
                ];



                foreach ($ArrayVideos as $video):
                    extract($video);
                    ?>

                    <article class="ds-inblock depoimento flex-3">
                        <div class="video-large no-margin">
                            <div class="video no-margin">
                                <div class="ratio js_media js_video_depoimento1"><iframe class="media" src="https://www.youtube.com/embed/<?= $depoimento_video; ?>" frameborder="0" allowfullscreen></iframe></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <h2><?= $depoimento_name; ?> - <?= $depoimento_cidade; ?></h2>
                        <div class="clear"></div>
                    </article>

                    <?php
                endforeach;


            else:
                $readVideos = new Read;
                $readVideos->ExeRead(DEPOIMENTOS, "WHERE depoimento_status = 1 AND depoimento_type = :type ORDER BY depoimento_order ASC LIMIT 3", "type=video");
                if ($readVideos->getResult()):
                    foreach ($readVideos->getResult() as $video):
                        extract($video);
                        ?>
                        <article class="ds-inblock depoimento flex-3">
                            <div class="video-large no-margin">
                                <div class="video no-margin">
                                    <div class="ratio js_media js_video_depoimento1"><iframe class="media" src="https://www.youtube.com/embed/<?= $depoimento_video; ?>" frameborder="0" allowfullscreen></iframe></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <h2><?= $depoimento_name; ?> - <?= BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf'] ?></h2>
                            <div class="clear"></div>
                        </article>
                        <?php
                    endforeach;
                endif;
            endif;
            ?>
        </div>
        <div class="clear"></div>
    </div>
</section>

<section class="container dobra_contato">
    <div class="content al-center">
        <div class="contato_info al-center">
            <header class="container m-bottom3">
                <h1>Entre em Contato</h1>
            </header>

            <div itemscope itemtype="https://schema.org/Person">
                <meta itemprop="name" content="<?= (!empty($_SESSION['theme']) ? NOME_RESPONSAVEL_EMPRESA_THEME : NOME_RESPONSAVEL_EMPRESA); ?>">
                <meta itemprop="jobTitle" content="Nutricionista">
                <meta itemprop="jobTitle" content="Coach Nutricional">
                <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                    <div class="bloco_endereco m-bottom3">
                        <!-- <p class="endereco" itemprop="streetAddress"><?= (!empty($_SESSION['theme']) ? ENDERECO_EMPRESA_THEME : ENDERECO_EMPRESA); ?></p>
                        <p class="cidade"><?= (!empty($_SESSION['theme']) ? CIDADE_EMPRESA_THEME : CIDADE_EMPRESA . ' - ' . UF_EMPRESA . ' - ' . PAIS_EMPRESA); ?></p>
                        <p class="cep">CEP.<?= (!empty($_SESSION['theme']) ? CEP_EMPRESA_THEME : CEP_EMPRESA); ?></p> -->
                        <meta itemprop="addressLocality" content="<?= CIDADE_EMPRESA; ?>">
                        <meta itemprop="addressRegion" content="<?= UF_EMPRESA; ?>">
                        <meta itemprop="addressCountry" content="<?= PAIS_EMPRESA; ?>">
                        <meta itemprop="postalCode" content="<?= CEP_EMPRESA; ?>">
                    </div>

                    <div class="bloco_tel_email">
                        <p class="telefone">Tel. <?= (!empty($_SESSION['theme']) ? TELEFONES_EMPRESA_THEME : TELEFONES_EMPRESA); ?></p>
                        <p class="email" itemprop="email"><?= (!empty($_SESSION['theme']) ? EMAIL_EMPRESA_THEME : EMAIL_EMPRESA); ?></p>
                        <meta itemprop="telephone" content="<?= (!empty($_SESSION['theme']) ? TELEFONES_EMPRESA_THEME : TELEFONES_EMPRESA); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
    <div class="sombra_contato"></div>
</section>


<section class="container dobra_dicas pd-top3 m-bottom3">
    <header class="sectiontitle no-margin m-top3">
        <h1>Dicas</h1>
    </header>

    <div class="content">
        <div class="flex container">
            <?php
            $readCategory = new Read;
            $readCategory->ExeRead(CATEGORIAS, "WHERE category_name = :categoria AND category_parent IS NULL", "categoria=dicas");
            if ($readCategory->getResult()):
                $IdCategoria = $readCategory->getResult()[0]['category_id'];
                $readDicas = new Read;
                $readDicas->ExeRead(POSTS, "WHERE post_cat_parent = :categoria AND post_status = 1 ORDER BY post_date DESC LIMIT :limit", "categoria={$IdCategoria}&limit=3");
//                var_dump($readDicas->getResult());
                if ($readDicas->getResult()):
                    foreach ($readDicas->getResult() as $dica):
                        extract($dica);
                        ?>
                        <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>" class="flex-3">
                            <article itemscope itemtype="https://schema.org/Article">
                                <div class="content">
                                    <header class="container m-bottom1">
                                        <div class="box_imagem">
                                            <img itemprop="image" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" />
                                        </div>
                                        <h1 itemprop="headline"><?= Check::Words($post_title, 6); ?></h1>

                                        <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">
                                        <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)) ?>">
                                        <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)) ?>">

                                        <span class="ds-none">
                                            <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                                                Por: <span itemprop="name">Luiz Felipe Lopes</span>
                                                <meta itemprop="url" content="https://plus.google.com/109917751422031829028">
                                            </span>
                                            <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                                                via <span itemprop="name"><?= BuscaRapida::buscarUsuario($post_author)['user_name'] . ' ' . BuscaRapida::buscarUsuario($post_author)['user_lastname']; ?></span>
                                                <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><img itemprop="url" src="<?= (!empty(BuscaRapida::buscarUsuario($post_author)['user_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . BuscaRapida::buscarUsuario($post_author)['user_cover'] : INCLUDE_PATH . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'logo.png'); ?>"></span>
                                                <meta itemprop="url" content="<?= HOME; ?>">
                                            </span>
                                        </span>

                                    </header>
                                    <p class="conteudo"><?= Check::Words($post_content, 44); ?></p>
                                    <p class="mais">Ver mais</p>



                                    <div class="clear"></div>
                                </div>
                            </article>
                        </a>

                        <?php
                    endforeach;
                endif;

            endif;
            ?>

        </div>

        <div class="clear"></div>

    </div>

</section>

<section class="container dobra_receitas m-bottom3 ds-none">
    <header class="sectiontitle no-margin m-top3">
        <h1>Receitas</h1>
    </header>

    <div class="content">
        <div class="flex container">

            <?php
            $readCategory = new Read;
            $readCategory->ExeRead(CATEGORIAS, "WHERE category_name = :categoria AND category_parent IS NULL", "categoria=receitas");
            if ($readCategory->getResult()):
                $IdCategoria = $readCategory->getResult()[0]['category_id'];
                $readReceitas = new Read;
                $readReceitas->ExeRead(POSTS, "WHERE post_cat_parent = :categoria AND post_status = 1 ORDER BY post_date DESC LIMIT :limit", "categoria={$IdCategoria}&limit=3");
//                var_dump($readDicas->getResult());
                if ($readReceitas->getResult()):
                    foreach ($readReceitas->getResult() as $receita):
                        extract($receita);
                        ?>

                        <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>" class="flex-3">
                            <article itemscope itemtype="https://schema.org/Article">
                                <div class="content">
                                    <header class="container m-bottom1">
                                        <div class="box_imagem">
                                            <img itemprop="image" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" />
                                        </div>
                                        <h1 itemprop="headline"><?= Check::Words($post_title, 6); ?></h1>
                                    </header>
                                    <p class="conteudo"><?= Check::Words($post_content, 44); ?></p>
                                    <p class="mais">Ver mais</p>

                                    <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">
                                    <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)); ?>">
                                    <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)); ?>">

                                    <span class="ds-none">
                                        <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                                            Por: <span itemprop="name">Luiz Felipe Lopes</span>
                                            <meta itemprop="url" content="https://plus.google.com/109917751422031829028">
                                        </span>
                                        <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                                            via <span itemprop="name"><?= BuscaRapida::buscarUsuario($post_author)['user_name'] . ' ' . BuscaRapida::buscarUsuario($post_author)['user_lastname']; ?></span>
                                            <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><img itemprop="url" src="<?= (!empty(BuscaRapida::buscarUsuario($post_author)['user_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . BuscaRapida::buscarUsuario($post_author)['user_cover'] : INCLUDE_PATH . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'logo.png'); ?>"></span>
                                            <meta itemprop="url" content="<?= HOME; ?>">
                                        </span>
                                    </span>

                                    <div class="clear"></div>
                                </div>
                            </article>
                        </a>

                        <?php
                    endforeach;
                endif;

            endif;
            ?>

        </div>

        <div class="clear"></div>
    </div>
</section>