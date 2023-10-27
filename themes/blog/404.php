<?php // $link = filter_input(INPUT_GET, 'link', FILTER_DEFAULT);  ?>
<?php $link = $Url[0]; ?>
<div class="container posts_box">
    <header class="sectiontitle sectiontitle-nomargin bg-blue_marinho">    
        <div class="content">

            <h1 class="al-center">Desculpe, nenhuma página ou artigo foi encontrado com o termo <strong><?= $link ?></strong></h1>
            <!--<p class="tagline al-center"><?= $pg_desc; ?></p>-->

            <div class="clear"></div>
        </div>
    </header>      


    <article class="container">
        <div class="content">
            <header class="sectiontitle">
                <h1>Deixe sua sujestão de Conteúdo:</h1>
                <p class="tagline">Informe seu nome e e-mail para sugerir conteúdo relacionado à <?= $setUrl; ?></p>
            </header>

            <form name="sendcontent" action="obrigado" method="post" class="bg-body">
                <input class="form-field box box-medium" type="text" title="Informe Seu Nome" name="nome" placeholder="Informe Seu Nome:" />
                <input class="form-field box box-medium" type="email" title="Informe Seu Email" name="email" placeholder="Informe Seu E-mail:" />

                <a href="#" class="btn btn-green radius box box-medium last al-center">Deixe Sua Sugestão</a>
            </form>
            <div class="clear"></div>
        </div>  
    </article>



    <section class="container bg-orange">
        <div class="content">
            <header class="sectiontitle">
                <h1>Veja Conteúdo Relacionado com a Sua Pesquisa:</h1>
                <p class="tagline">Veja o que encontramos ao pesquisar por <b><?= $link; ?></b> em nossa base de conhecimento.</p>
            </header>

            <?php
            $read = new Read();
            $read->ExeRead(POSTS, "WHERE post_status = 1 AND (post_name LIKE '%' :like '%') ORDER BY rand()", "like={$link}");
            if (!$read->getResult()):

                WSErro("Desculpe! Ainda não Posts Que foram Publicados Além deste Acima!", WS_INFOR);

            else:
                foreach ($read->getResult() as $posts):
                    extract($posts);
                    ?>

                    <article class="post_item post_item_posts post_box">
                        <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                            <meta itemprop="width" content="300" />
                            <meta itemprop="height" content="180" />
                        </span>

                        <span class="post_item_content">
                            <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name; ?>">
                                <h1 itemprop="name"><?= Check::Words($post_title, 10); ?></h1>
                                <span><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                                <p itemprop="description"><?= Check::Words($post_content, 50); ?></p>
                            </a>

                            <a class="mais link" title="Ver Mais" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name; ?>">Ver mais...</a>

                        </span>

                        <div class="post_item_author">
                            <div class="image">
                                <img class="round" title="Nilma Nayara Neves" alt="[Nilma Nayara Neves]" src="<?= INCLUDE_PATH ?>/img/foto-novo-post.png"/>
                            </div>
                            <p class="fl-right">Nilma Nayara Neves</p>
                        </div>
                    </article>



                    <?php
                endforeach;

            endif;
            ?>

            <div class="clear"></div>
        </div>
    </section>



</div>  
