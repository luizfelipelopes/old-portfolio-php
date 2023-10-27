<?php

/**
 * ajax_filter_leads.inc.php - <b>FILTRAR LEADS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Filtro de Comentários
 */
if (!empty($Post)):

    if (!empty($Post['date']) && !empty($Post['origin'])):

        $Date = '';
        if ($Post['date'] == 'todos'):
            $Date = '';
        elseif ($Post['date'] == 'hora'):
            $Date = 'lead_date <= NOW() AND lead_date > NOW() - INTERVAL 1 HOUR';
        elseif ($Post['date'] == 'semana'):
            $Date = 'lead_date <= NOW() AND lead_date > NOW() - INTERVAL 1 WEEK';
        elseif ($Post['date'] == 'mes'):
            $Date = 'lead_date <= NOW() AND lead_date > NOW() - INTERVAL 1 MONTH';
        elseif ($Post['date'] == 'ano'):
            $Date = 'lead_date <= NOW() AND lead_date > NOW() - INTERVAL 1 YEAR';
        endif;

        $SqlDate = ($Post['date'] == 'todos' ? '' : $Date);
        $SqlOrigin = ($Post['origin'] == 'todos' ? '' : (!empty($SqlDate) ? ' AND ' : '') . 'lead_type = "' . $Post['origin'] . '"');
        $Sql = ($Post['date'] == 'todos' && $Post['origin'] == 'todos' ? '' : ' WHERE ') . $SqlDate . $SqlOrigin;
    else:
        $Sql = '';
    endif;

    $Pager = new Pager("?exe=emails/index&pag=");
    $Pager->ExePager(1, 12);

    $readLeads = new Read;
    $readLeads->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . $Sql . " ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//    var_dump($readLeads->getResult());
//    die;


    if ($readLeads->getResult()):
        $jSon['leads'] = '';

        foreach ($readLeads->getResult() as $lead):

            extract($lead);

            $jSon['leads'] .= '<article id="' . $lead_id . '" class="leads_item js_item">';
            $jSon['leads'] .= '<span class="leads_item_code">#' . sprintf("%06d", $lead_id) . '</span>';
            $jSon['leads'] .= '<span class="leads_item_mail icon-mail dont-break-out">' . $lead_email . '</span>';
            $jSon['leads'] .= '<span class="leads_item_name">' . $lead_name . '</span>';
            $jSon['leads'] .= '<span class="leads_item_date icon-clock">' . date("d/m/Y \à\s H:i\h", strtotime($lead_date)) . '</span>';
            $jSon['leads'] .= '<span class="leads_item_origin icon-tag">' . (!empty($lead_type) ? $lead_type : 'Sem origem') . '</span>';
            $jSon['leads'] .= '<a id="' . $lead_id . '" attr-action="delete_lead" title="" href="#" class="btn btn-red icon-trash radius js_btn_delete">Excluir</a>';
            $jSon['leads'] .= '</article>';

        endforeach;

    endif;

    $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . $Sql . " ORDER BY lead_date DESC");
    $jSon['paginator'] = '<div class="js_paginator" attr-action="paginator_leads">';
    $jSon['paginator'] .= (!empty($Pager->getPaginator()) ? '<div class="paginator_container">' . $Pager->getPaginator() . '</div>' : '');
    $jSon['paginator'] .= '</div>';

endif;
