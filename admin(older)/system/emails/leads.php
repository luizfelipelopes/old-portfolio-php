<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Leads</h1>
            <p class="tagline"> >> Flow State / <b>Leads</b></p>
        </div>

        <form action="" method="POST" id="j_filtro_pedidos" class="filtro_pedido_status fl-right m-bottom1">
            <div class="form-group">
                <label for="filtro" class="m-bottom1">Filtrar por Fonte:</label>
                <select name="filtro" class="form-control" attr-action="filtrar_type_lead">
                    <option value="todos" selected>Todos</option>
                    <option value="horizontal-topo">Horizontal Topo</option>
                    <option value="banner">Banner</option>
                    <option value="sidebar">Sidebar</option>
                    <option value="footer">Footer</option>
                    <option value="modal">Modal</option>

                </select>
            </div>
        </form>

        <form action="" method="POST" id="j_filtro_pedidos" class="filtro_pedido_data fl-right m-bottom1" style="margin-right:2% !important;">
            <div class="form-group">
                <label for="filtro" class="m-bottom1">Filtrar por data:</label>
                <select name="filtro" class="form-control" attr-action="filtrar_data_lead">
                    <option value="todos" selected>Em qualquer data</option>
                    <option value="ultima-hora">Na última hora</option>
                    <option value="24-horas">Nas últimas 24 horas</option>
                    <option value="ultima-semana">Na última semana</option>
                    <option value="ultimo-mes">No último mês</option>
                    <option value="ultimo-ano">No último ano</option>
                    <option value="personalizado">Intervalo Personalizado</option>
                </select>
            </div>
        </form>



        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line m-bottom3"></div>



<div class="j_detalhes_pedido"></div>

<!--ÚLTIMOS LEADS-->
<article class="container main-conteudo ultimos-pedidos widgets-abaixo m-bottom3 table-pedidos js_paginator">

    <a href="?exe=emails/leads&download_file=true" class="btn btn-green m-bottom3">Exportar Leads</a>

    <header class="bg-green-claro">
        <div class="content">
            <h1 class="caps-lock font-bold">Últimos Leads</h1>
            <div class="clear"></div>
        </div>    

    </header>

    <!--<div class="j_pedidos_real_time"></div>-->
    <div class="j_post_conteudo">

        <?php
        $getPage = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);


        $Pager = new Pager("dashboard.php?exe=emails/leads&pag=");
        $Pager->ExePager($getPage, 12);


        $read = new Read();
        $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

        if (!$read->getResult()):

            WSErro("Nenhum lead foi cadastrado ainda.", WS_INFOR);

        else:
            $indice = 0;
            foreach ($read->getResult() as $pedido):
                extract($pedido);
                ?>

                <div class="bg-body">
                    <div class="container linha pointer" id="<?= $lead_id; ?>">
                        <div class="content b-bottom j_post_conteudo">
                            <div class="col-10"><span>#<?= sprintf("%05d", $indice + 1); ?></span></div>
                            <div class="col-20"><span><?= $lead_name; ?></span></div>
                            <div class="col-30"><span><?= $lead_email; ?></span></div>
                            <div class="col-20"><span><?= date('d/m/Y H\h:i', strtotime($lead_date)); ?></span></div>
                            <div class="col-10"><span class="font-bold"><?= $lead_type; ?></span></div>
                            <div class="col-5 botoes botoes-emails al-center">
                                <a class="btn btn-pink radius shorticon shorticon-excluir j_confirm" title="Excluir Post" id="<?= $lead_id; ?>"></a>
                                <div class="bloco-confirm" id="<?= $lead_id; ?>">
                                    <small class="msg-confirm">Deseja excluir?</small>
                                    <a class="btn btn-orange btn-confirm btn-confirm-sim radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_lead" id="<?= $lead_id; ?>">Sim</a>
                                    <a class="btn btn-pink btn-confirm btn-confirm-nao radius j_cancelar" title="Cancelar Exclusão" href="#" id="<?= $lead_id; ?>">Não</a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <?php
                    $indice++;
                endforeach;
                $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC");
                ?>
                <div class="j_paginator" attr-action="paginator_lead">
                    <?php
                    echo $Pager->getPaginator();
                endif;
                ?>


                <div class="clear"></div>
            </div>
        </div>
    </div>
</article>
<!--ÚLTIMOS LEADS-->