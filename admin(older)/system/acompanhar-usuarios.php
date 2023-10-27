
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Acompanhar Usuários</h1>
            <p class="tagline"> >> Flow State / <b>Acompanhar Usuários</b></p>
        </div>
        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line m-bottom3"></div>

<article class="container main-conteudo modulos m-bottom3 fl-left estatisticas_online table-online">

    <?php
    $dateHoje = date('Y-m-d H:i:s');
    $readOnline = new Read();
    $readOnline->ExeRead(SITEVIEWS_ONLINE, "WHERE online_endview >= :date ORDER BY online_endview DESC", "date={$dateHoje}");
    if (!$readOnline->getResult()):

        WSErro("Nenhum Usuário Online no Momento", WS_INFOR);
    else:
        ?>

        <header class="bg-green-claro fl-left">
            <div class="content">
                <h1 class="shorticon shorticon-pedidos ds-inblock caps-lock font-bold">Acompanhar Usuários</h1>
                <div class="clear"></div>
            </div>    
        </header>

        <div class="bg-body">

            <div class="container linha bg-gray">
                <div class="content">
                    <div class="coluna box box-small col-30 caps-lock font-bold"><span>IP</span></div>
                    <div class="coluna box box-small col-30 caps-lock font-bold"><span>Url</span></div>
                    <div class="coluna box box-small col-30 caps-lock font-bold"><span>Navegador</span></div>
                    <div class="clear"></div>
                </div>
            </div>


            <?php
            //                    var_dump($read->getResult()[0]);
            foreach ($readOnline->getResult() as $online) :


                extract($online);
                ?>

                <div class="container linha">
                    <div class="content">
                        <div class="coluna box box-small col-30"><span><?= $online_ip; ?></span></div>
                        <div class="coluna box box-small col-30"><span><?= $online_url; ?></span></div>
                        <div class="coluna box box-small col-30"><span><?= $agent_name; ?></span></div>
                        <div class="clear"></div>
                    </div>
                </div>

                <?php
            endforeach;
        endif;
        ?>

        <div class="clear"></div>
    </div>
</article>
