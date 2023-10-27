<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">E-mails</h1>
            <p class="tagline"> >> Flow State / <b>E-mails</b></p>
        </div>
        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line m-bottom3"></div>

<div class="j_detalhes_pedido"></div>

<!--ÚLTIMOS PEDIDOS-->
<article class="container main-conteudo ultimos-pedidos widgets-abaixo m-bottom3">

    <header class="bg-green-claro linha">
        <div class="content b-bottom">
            <div class="col-10"><span>Código</span></div>
            <div class="col-20"><span>E-mail</span></div>
            <div class="col-20"><span>Conteúdo</span></div>
            <div class="col-15"><span>Tipo</span></div>
            <div class="col-25"><span>Data</span></div>

            <div class="clear"></div>
        </div>
    </header>

    <div class="j_pedidos_real_time"></div>


    <?php
//        $transacao = new TransacoesPagSeguro();
//        $response = new TransacoesPagSeguro;
//        $transacao->getTransacoesPorData('2016-08-27', date('Y-m-d'));



    $read = new Read();
    $read->ExeRead(EMAILS, "ORDER BY email_date DESC");

    if (!$read->getResult()):

        WSErro("Nenhum e-mail foi criado ainda.", WS_INFOR);

    else:

        $j = 0;
        foreach ($read->getResult() as $pedido):

            extract($pedido);
            ?>

            <div class="bg-body">
                <div class="container linha pointer">
                    <div class="content b-bottom">
                        <div class="col-10 coluna-codigo bg-light"><span>#<?= sprintf("%05d", $j + 1); ?></span></div>
                        <div class="col-20"><span><?= $email_title; ?></span></div>
                        <div class="col-20"><span><?= Check::Words($email_content, 3); ?></span></div>
                        <div class="col-15"><span><?= ($email_type == 'pos-venda' ? 'Pós-venda' : 'Pós-Cadastro'); ?></span></div>
                        <div class="col-25"><span><?= date('d/m/Y H\h:i', strtotime($email_date)); ?></span></div>
                        
                        <div class="botoes botoes-emails al-center col-5">
                            <a class="btn btn-blue radius shorticon shorticon-editar" title="Editar E-mail" href="?exe=emails/create&id=<?= $email_id;?>"></a>
                            <a class="btn btn-pink radius shorticon shorticon-excluir j_confirm ds-none" title="Excluir E-mail" id="<?= $email_id;?>"></a>
                            <div class="bloco-confirm" id="<?= $email_id;?>">
                                <small class="msg-confirm">Deseja excluir?</small>
                                <a class="btn btn-orange btn-confirm btn-confirm-sim radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_email" id="<?= $email_id;?>">Sim</a>
                                <a class="btn btn-pink btn-confirm btn-confirm-nao radius j_cancelar" title="Cancelar Exclusão" href="#" id="<?= $email_id;?>">Não</a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

                <?php
                $j++;
            endforeach;

        endif;
        ?>

        <div class="clear"></div>
    </div>
</article>
<!--ÚLTIMOS PEDIDOS-->