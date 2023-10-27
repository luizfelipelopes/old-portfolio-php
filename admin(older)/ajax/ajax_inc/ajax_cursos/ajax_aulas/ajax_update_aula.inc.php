<?php

/**
 * ajax_update_aula.inc.php - <b>UPDATE AULAS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Disciplinas do Módulo do Curso
 */
$id = $Post['aula_id'];
$aula_curso = $Post['aula_curso'];
$jSon['id'] = $id;

unset($Post['aula_id'], $Post['aula_curso']); // aula_id E aula_curso NÂO ENTRAM NA BASE BASE DE DADOS
// POR ISSO PRECISAM SER TIRADOS                                          

if (isset($_FILES['material_aula']) && $_FILES['material_aula']['tmp_name']): //VERIFICA SE TEM ALGUM UPLOAD DE ARQUIVOS
    $i = 0;
    $j = count($_FILES['material_aula']['tmp_name']); // RECUPERA O NÙMERO DE ARQUIVOS QUE FOI FEITO UPLOAD
    $erros = 0;

//            O ARRAY $_FILES PRECISA SER SEPARADO CORRETAMENTE, POIS OS ARQUIVOS DE UPLOAD ESTÂO MISTURADOS NELE 
    for ($x = 0; $x < $j; $x++):
        foreach ($_FILES['material_aula'] as $arquivo):
            $Post['material_aula'][$i] = $arquivo[$x]; // OS ATRIBUTOS DO ARQUIVO PASSAM A SER ORGANIZADOS
// PEGANDO SEUS RESPECTIVOS ATRIBUTOS                                         
            $i++;
        endforeach;
        $i = 0;
//                CADA ATRIBUTO DOS ARQUIVOS UPDADOS SÂO NOMEADOS E INSERIDO EM UM NOVO ARRAY ($File)
        $File = [
            "name" => $Post['material_aula'][0],
            "type" => $Post['material_aula'][1],
            "tmp_name" => $Post['material_aula'][2],
            "error" => $Post['material_aula'][3],
            "size" => $Post['material_aula'][4]
        ];

//                var_dump($File);
        $adminMaterial = new adminMaterial;

//                SE EXISTE ID DO MATERIAL, ELE SERÁ ATUALIZADO. CASO CONTRÁRIO SERÀ CADASTRADO COMO UM NOVO REGISTRO NO BD
        if (isset($material_id)):

            $adminMaterial->ExeUpdate($material_id[$x], $File); // ATUALIZA MATERIAL

            $jSon['hide_field'] = true; // HABILITA O CULTAMENTO DOS INPUTS E VISIBILIDADE DE TODOS OS ARQUIVOS UPDADOS NA AULA
//                    LÊ TODOS OS MATERIAIS UPADOS PARA A AULA
            $readMaterial = new Read;
            $readMaterial->ExeRead(MATERIAIS, "WHERE material_aula = :aula", "aula={$id
                    }");
            if ($readMaterial->getResult()):
//                        SE HPUVER ALGUM, OS ARQUIVOS E O TOTAL DE ARQUIVOS SERÂO MANDADOS PARA O SCRIPT EM jQUERY
                $jSon['result_materiais'] = $readMaterial->getResult();
                $jSon['total_materiais'] = $readMaterial->getRowCount();

            endif;
        else:
            $adminMaterial->ExeCreate($id, $File); // CADASTRA MATERIAL
            $jSon['hide_field'] = true; // HABILITA O CULTAMENTO DOS INPUTS E VISIBILIDADE DE TODOS OS ARQUIVOS UPDADOS NA AULA
//                    LÊ TODOS OS MATERIAIS UPADOS PARA A AULA
            $readMaterial = new Read;
            $readMaterial->ExeRead(MATERIAIS, "WHERE material_aula = :aula", "aula={$id
                    }");
            if ($readMaterial->getResult()):
//                         SE HOUVER ALGUM, OS ARQUIVOS E O TOTAL DE ARQUIVOS SERÂO MANDADOS PARA O SCRIPT EM jQUERY
                $jSon['result_materiais'] = $readMaterial->getResult();
                $jSon['total_materiais'] = $readMaterial->getRowCount();

            endif;

        endif;

// SE HOUVE ALGUM ERRO AO FAZER O UPLOAD DE ARQUIVOS, ELE É CONTADO PARA INDICAR UM ERRO EXISTENTE
// E O ERRO ESPECÌFICO SERÁ ENVIADO VIA jSON
        if (!$adminMaterial->getResult()):
            $erros ++;
            $jSon['error'] = [$adminMaterial->getError()[0], $adminMaterial->getError()[1]];
        endif;

    endfor;

//            RETIRA O CAMPO material_aula, POIS NÃO SERÁ INSERIDO NO BD
    unset($Post['material_aula']);

endif;


$meuArray = array();

//        TIRA OS REGISTROS DE CHAVES NUMÉRICAS POSSUI JQUERY.FORM PROVOCA ESSE EFEITO COLATERAL
foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//        VERIFICA SE FOI REGISTRADO UM ERRO DE UPLOAD DOS ARQUIVOS. CASO NENHUM ERRO TENHA OCORRIDO A AULA SERÁ ATUALIZADA
if (!isset($erros) || !$erros):
    $adminAula = new adminAula;
    $adminAula->ExeUpdate($id, $meuArray);
    $jSon['error'] = $adminAula->getError();
        endif;