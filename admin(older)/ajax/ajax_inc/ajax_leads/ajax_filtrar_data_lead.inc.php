<?php

/**
 * ajax_filtrar_data_lead.php - <b>FILTRAR LEADS POR DATA</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Filtro de Leads por Data
 */
$Pager = new Pager("dashboard.php?exe=emails/leads&pag=");
$Pager->ExePager(1, 12);

$read = new Read;

if ($Post['key'] == 'todos'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
elseif ($Post['key'] == 'ultima-hora'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-1 hour', strtotime(date('Y-m-d H:i:s')))) . "");
elseif ($Post['key'] == '24-horas'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-24 hours', strtotime(date('Y-m-d H:i:s')))) . "");
elseif ($Post['key'] == 'ultima-semana'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-7 days', strtotime(date('Y-m-d H:i:s')))) . "");
elseif ($Post['key'] == 'ultimo-mes'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-1 month', strtotime(date('Y-m-d H:i:s')))) . "");
elseif ($Post['key'] == 'ultimo-ano'):
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-1 year', strtotime(date('Y-m-d H:i:s')))) . "");
elseif ($Post['key'] == 'data_personalizada' && (!empty($Post['data-inicio']) && !empty($Post['data-fim']))):
//    var_dump($Post);
//    die;
//    unset($Post['key']);
    $jSon['filtro_personalizado'] = true;
    $jSon['naolimpar'] = 'id';
    $read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&date2=" . date('Y-m-d H:i:s', strtotime('+1 day', strtotime($Post['data-fim']))) . "&date=" . $Post['data-inicio'] . "");

endif;

if (!$read->getResult()):

    $jSon['error'] = ["Nehum lead neste período foi encontrado", "infor"];
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

    if ($Post['key'] == 'todos'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC");
    elseif ($Post['key'] == 'ultima-hora'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC", "date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-1 hour', strtotime(date('Y-m-d H:i:s')))) . "");
    elseif ($Post['key'] == '24-horas'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC", "date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-24 hours', strtotime(date('Y-m-d H:i:s')))) . "");
    elseif ($Post['key'] == 'ultima-semana'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC", "date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-7 days', strtotime(date('Y-m-d H:i:s')))) . "");
    elseif ($Post['key'] == 'ultimo-mes'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC", "date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-1 month', strtotime(date('Y-m-d H:i:s')))) . "");
    elseif ($Post['key'] == 'ultimo-ano'):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC", "date2=" . date('Y-m-d H:i:s') . "&date=" . date('Y-m-d H:i:s', strtotime('-1 year', strtotime(date('Y-m-d H:i:s')))) . "");
    elseif ($Post['key'] == 'data_personalizada' && (!empty($Post['data-inicio']) && !empty($Post['data-fim']))):
        $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " WHERE lead_date >= :date AND lead_date <= :date2 ORDER BY lead_date DESC", "date2=" . date('Y-m-d H:i:s', strtotime('+1 day', strtotime($Post['data-fim']))) . "&date=" . $Post['data-inicio'] . "");
//        unset($Post['key']);
    endif;

    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_lead">';
    $jSon['paginator'] = $Pager->getPaginator();

endif;
