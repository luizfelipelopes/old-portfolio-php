<?php

/**
 * ajax_delete_modulo.inc.php - <b>DELETE MÓDULO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Modulos do Curso
 */
$read = new Read;
$read->ExeRead(MODULOS);
if ($read->getRowCount() == 1):
    $json['show_field'] = true;
    $jSon['error'] = ["Não há módulos cadastrados para este curso. Crie um!", "infor"];
endif;


$deleteModulo = new adminModulo;
$readAulas = new Read;
$readAulas->ExeRead(AULAS, "WHERE aula_modulo = :modulo", "modulo={$Post['id']
        }");
if ($readAulas->getResult()):

    $deleteMaterial = new Delete;
    $deleteAulas = new Delete;

    $readMateriais = new Read;

    $i = 0;
    foreach ($readAulas->getResult() as $aula):

        $readMateriais->ExeRead(MATERIAIS, "WHERE material_aula = :aula", "aula={$aula['aula_id']
                }");
        if ($readMateriais->getResult()):
            $i++;
        endif;


    endforeach;

    if ($i > 0):

        $i = 0;
        foreach ($readAulas->getResult() as $aula):

            $deleteMaterial->ExeDelete(MATERIAIS, "WHERE material_aula = :aula", "aula={$aula['aula_id']
                    }");

            if (!$deleteMaterial->getResult()):

                $i++;

            endif;

        endforeach;

        if ($i == 0):
            $deleteAulas->ExeDelete(AULAS, "WHERE aula_modulo = :modulo", "modulo={$Post['id']
                    }");
            if ($deleteAulas->getResult()):
                $deleteModulo->ExeDelete($Post['id']);
                $jSon['error'] = [$deleteModulo->getError()[0], $deleteModulo->getError()[1]];
            endif;
        endif;
    elseif ($i == 0):
        $deleteAulas->ExeDelete(AULAS, "WHERE aula_modulo = :modulo", "modulo={$Post['id']
                }");
        if ($deleteAulas->getResult()):
            $deleteModulo->ExeDelete($Post['id']);
            $jSon['error'] = [$deleteModulo->getError()[0], $deleteModulo->getError()[1]];
        endif;

    endif;
else:

    $deleteModulo->ExeDelete($Post['id']);
    $jSon['error'] = [$deleteModulo->getError()[0], $deleteModulo->getError()[1]];
        endif;





//        var_dump($Post);

