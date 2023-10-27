<?php

/**
 * ajax_filtrar_type_lead.inc.php - <b>FILTRAR TIPO DE LEAD</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de FIltro de Type do Lead em REAL-TIME
 */
$Pager = new Pager("dashboard.php?exe=emails/leads&pag=");
$Pager->ExePager((!empty($_SESSION['pagina']) ? $_SESSION['pagina'] : 1), 12);

$read = new Read;

if ($Post['key'] == 'horizontal-topo'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&type=horizontal-topo");
elseif ($Post['key'] == 'banner'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&type=banner");
elseif ($Post['key'] == 'sidebar'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&type=sidebar");
elseif ($Post['key'] == 'footer'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&type=footer");
elseif ($Post['key'] == 'modal'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&type=modal");
else:
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
endif;

if (!$read->getResult()):

    $jSon['error'] = ["Nehum lead pelo <strong>" . $Post['key'] . "</strong> ainda", "infor"];
else:

    $j = 0;
    $indice = 0;
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();

    foreach ($read->getResult() as $lead):
        extract($lead);

        $jSon['result'] += [$j => '<div class="bg-body">
                <div class="container linha pointer js_paginator" id="' . $lead_id . '">
                    <div class="content b-bottom">
                        <div class="col-10"><span>#' . sprintf("%05d", $indice + 1) . '</span></div>
                        <div class="col-20"><span>' . $lead_name . '</span></div>
                        <div class="col-30"><span>' . $lead_email . '</span></div>
                        <div class="col-20"><span>' . date('d/m/Y H\h:i', strtotime($lead_date)) . '</span></div>
                        <div class="col-10"><span class="font-bold">' . $lead_type . '</span></div>
                        <div class="col-5 botoes botoes-emails al-center">
                            <a class="btn btn-pink radius shorticon shorticon-excluir j_confirm" title="Excluir Post" id="' . $lead_id . '"></a>
                            <div class="bloco-confirm" id="' . $lead_id . '">
                                <small class="msg-confirm">Deseja excluir?</small>
                                <a class="btn btn-orange btn-confirm btn-confirm-sim radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_lead" id="' . $lead_id . '">Sim</a>
                                <a class="btn btn-pink btn-confirm btn-confirm-nao radius j_cancelar" title="Cancelar Exclusão" href="#" id="' . $lead_id . '">Não</a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
'];
        $j++;
        $indice++;

    endforeach;

    if ($Post['key'] == 'horizontal-topo'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC", "type=horizontal-topo");
    elseif ($Post['key'] == 'banner'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC", "type=banner");
    elseif ($Post['key'] == 'sidebar'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC", "type=sidebar");
    elseif ($Post['key'] == 'footer'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC", "type=footer");
    elseif ($Post['key'] == 'modal'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_type = :type ORDER BY lead_date DESC", "type=modal");
    else:
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC");
    endif;

    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_lead">';
    $jSon['paginator'] = $Pager->getPaginator();

endif;

