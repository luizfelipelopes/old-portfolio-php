<!DOCTYPE html>
<!--
Página: See Leads (Ver Leads)
Author: Luiz Felipe C. Lopes
Date: 31/08/2018
-->

<?php
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$Pager = new Pager("?exe=emails/index&pag=");
$Pager->ExePager($getPage, 12);
$readLeads = new Read;
$readLeads->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
if (!$readLeads->getResult()):
    echo 'Nenhum lead ainda!';
else:
    ?>

    <div class="lead_options">

        <form action="" method="post">
            <input type="hidden" name="action" value="filter_leads">
            <select id="js_filter_date" name="filter_date" class="js_filter_leads">
                <option value="todos">Todas as datas</option>
                <option value="hora">Última hora</option>
                <option value="semana">Última semana</option>
                <option value="mes">Último mês</option>
                <option value="ano">Último ano</option>
            </select>
        </form>

        <form action="" method="post">
            <input type="hidden" name="action" value="filter_leads">
            <select id="js_filter_origin" name="filter_origem" class="js_filter_leads">
                <option value="todos">Todas as origens</option>
                <option value="pagina-venda">Página de vendas</option>
                <option value="form-contato">Formulário de Contato</option>
                <option value="form-sidebar">Opt-in Sidebar</option>
                <option value="form-conteudo">Opt-in Conteúdo</option>
                <option value="form-sugestao">Opt-in Sugestão</option>
            </select>
        </form>

        <a title="Exportar Leads" href="?exe=emails/leads&download_file=true" class="btn btn-blue icon-file radius">Exportar Leads</a>

    </div>

    <section class="leads js_leads">
        <h2>Leads</h2>

        <?php
        foreach ($readLeads->getResult() as $lead):
            extract($lead);
            ?>

            <article id="<?= $lead_id; ?>" class="leads_item js_item">
                <span class="leads_item_code">#<?= sprintf("%06d", $lead_id); ?></span>
                <span class="leads_item_mail icon-mail dont-break-out"><?= $lead_email; ?></span>
                <span class="leads_item_name"><?= $lead_name; ?></span>
                <span class="leads_item_date icon-clock"><?= date("d/m/Y \à\s H:i\h", strtotime($lead_date)); ?></span>
                <span class="leads_item_origin icon-tag"><?= (!empty($lead_type) ? $lead_type : 'Sem origem'); ?></span>
                <a id="<?= $lead_id; ?>" attr-action="delete_lead" title="" href="#" class="btn btn-red icon-trash radius js_btn_delete">Excluir</a>
            </article>

        <?php endforeach; ?>

        <div class="js_paginator" attr-action="paginator_leads">
            <?php
            $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC");
            $Paginator = $Pager->getPaginator();

            if (!empty($Paginator)):
                ?>
                <div class="paginator_container">
                    <?php echo $Paginator; ?>
                </div>
            <?php endif; ?>
        </div>

    </section>
    <?php include 'inc/confirmation_delete_message.inc.php'; ?>
<?php
endif;
?>

