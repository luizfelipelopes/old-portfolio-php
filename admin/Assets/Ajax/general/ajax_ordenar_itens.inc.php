<?php

/**
 * ajax_ordenar_itens.php - <b>Ordenar Itens</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Ordenação de Itens
 */
if (!empty($Post)):
    
    $ArrayItens = $Ordenacao;

    foreach ($ArrayItens as $Key => $Value):

        $updateOrder = new Update;

        switch ($Post['item']):
            case 'depoimento':
                $updateOrder->ExeUpdate(DEPOIMENTOS, ['depoimento_order' => $Value[1]], "WHERE depoimento_id = :id AND depoimento_type = :type", "id={$Value[0]}&type={$Post['type']}");
                break;
            case 'destaque':
                $updateOrder->ExeUpdate(DESTAQUES, ['destaque_order' => $Value[1]], "WHERE destaque_id = :id AND destaque_type = :type", "id={$Value[0]}&type={$Post['type']}");
                break;
            case 'curso':
                break;
            case 'modulo':
                break;
            case 'disciplina':
                break;
            default:
                $jSon['error'] = ['Este item não pode ser ordenado', 'infor'];
                break;
        endswitch;

        if (!$updateOrder->getResult()):
            $jSon['error'] = ["Erro ao atualizar ordem", 'error'];
        else:
            $jSon['error'] = ["Ordem atualizada com sucesso", 'success'];
        endif;

    endforeach;

endif;


