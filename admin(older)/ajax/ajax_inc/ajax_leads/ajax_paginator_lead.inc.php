<?php

/**
 * ajax_paginator_destaque.php - <b>PAGINAÇÂO DESTAQUES</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Paginação dos Destaques em REAL-TIME
 */
$Pager = new Pager("dashboard.php?exe=emails/leads&pag=");
$Pager->ExePager($Post['pagina'], 12);
$_SESSION['pagina'] = $Post['pagina'];

//$QueryPesquisa = (!empty($_SESSION['pesquisa']) ? "WHERE (destaque_title LIKE '%' :like '%' OR destaque_subtitle LIKE '%' :like '%') " : '');
//$PlacesPesquisa = (!empty($_SESSION['pesquisa']) ? "like={$_SESSION['pesquisa']}&" : '');

$read = new Read;
$read->FullRead("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):

    $jSon[' error'] = ["Nehum lead ainda", "infor"];

else:
    $j = 0;
    $indice = 0;
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
//    $View = new View;
//    $tpl_destaque = $View->Load('destaque');
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

    $Pager->ExeFullPaginator("SELECT lead_id, lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC");
    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_lead">';
    $jSon['paginator'] = $Pager->getPaginator();
    
endif;