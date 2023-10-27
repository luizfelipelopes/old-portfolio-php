<!--POSTS MAIS VISTOS-->
<section class="container posts posts_box m-bottom3" id="j_content">

    <?php
    $readPag = new Read();
    $readPag->ExeRead("gabadi_paginas", "WHERE pagina_name = :name", "name={$Link->getLocal()[0]}");
    if (!$readPag->getResult()):
        WSErro("Ainda Não Existe Conteúdo Para Esta Página", WS_INFOR);
    else:
        extract($readPag->getResult()[0]);
        ?>
    
    <header class="bg-blue_marinho al-center no-margin">
        <div class="content">
            <h1 class="caps-lock m-bottom1 fontsize1b"><?=$pagina_title?></h1>
            <p class="tagline"><?=$pagina_desc;?></p>
            <div class="clear"></div>
        </div>
    </header>
    
    
    <div class="banner container bg-gray ds-none">
    <a title="" href="">
        <picture alt="Gabadi">
<!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
            <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
            <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
            <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
            <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
            <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
            <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
            <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/temaGabadi2.jpg" />
        </picture>
    </a>
    </div>    

    <div class="separator fl-left m-bottom3"></div>
    
    
    <div class="content content_category">

        <article class="box video_box">
            <h1 class="fontzero">Video 1</h1>
            <div class="video no-margin">
                <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/um2Hwewdf3E" frameborder="0" allowfullscreen></iframe></div>
            </div>
        </article>
        
        <article class="box video_box">
            <h1 class="fontzero">Video 2</h1>
            <div class="video no-margin">
                <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/2GJCfKq-slo" frameborder="0" allowfullscreen></iframe></div>
            </div>
        </article>
        
        <article class="box video_box">
            <h1 class="fontzero">Video 3</h1>
            <div class="video no-margin">
                <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/Z491B2PDLDs" frameborder="0" allowfullscreen></iframe></div>
            </div>
        </article>
        
        <article class="box video_box">
            <h1 class="fontzero">Video 4</h1>
            <div class="video no-margin">
                <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/_1hDl3-xh9Y" frameborder="0" allowfullscreen></iframe></div>
            </div>
        </article>
        
        
        <article class="box video_box">
            <h1 class="fontzero">Video 5</h1>
            <div class="video no-margin">
                <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/8EG8APC3oMk" frameborder="0" allowfullscreen></iframe></div>
            </div>
        </article>
        
        <article class="box video_box last">
            <h1 class="fontzero">Video 6</h1>
            <div class="video no-margin">
                <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/8EG8APC3oMk" frameborder="0" allowfullscreen></iframe></div>
            </div>
        </article>

        <?php
        endif;
        ?>
        <div class="clear"></div>
    </div>   
</section>
