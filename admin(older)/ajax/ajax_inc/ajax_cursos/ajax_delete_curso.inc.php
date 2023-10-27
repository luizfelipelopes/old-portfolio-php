<?php

/**
 * ajax_delete_curso.inc.php - <b>DELETE CURSO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Cursos
 */
$read = new Read;
$read->ExeRead(CURSOS);
if ($read->getRowCount() == 1):
    $jSon['error'] = ["Não há cursos cadastrados", "WS_INFOR"];
endif;

$deleteModulos = new Delete;
$deleteAulas = new Delete;
$readModulos = new Read;
$readModulos->ExeRead(MODULOS, "WHERE modulo_curso = :curso", "curso={$Post['id']
        }");
if ($readModulos->getResult()):

    $readAulas = new Read;
    foreach ($readModulos->getResult() as $modulo):

        $readAulas->ExeRead(AULAS, "WHERE aula_modulo = :modulo", "modulo={$modulo['modulo_id']
                }");

        if ($readAulas->getResult()):
            $readMateriais = new Read;
            foreach ($readAulas->getResult() as $aula):
                $readMateriais->ExeRead(MATERIAIS, "WHERE material_aula = :aula", "aula={$aula['aula_id']
                        }");
                if ($readMateriais->getResult()):

                    foreach ($readMateriais->getResult() as $arq):
                        $material = '../../uploads' . $arq['material_name'];
                        if (file_exists($material) && !is_dir($material)):
                            unlink($material);
                        endif;
                    endforeach;

                    $deleteMateriais = new Delete;
                    $deleteMateriais->ExeDelete(MATERIAIS, "WHERE material_aula = :aula", "aula={$aula['aula_id']
                            }");
                    if ($deleteMateriais->getResult()):
                        $deleteAulas->ExeDelete(AULAS, "WHERE aula_id = :id", "id={$aula['aula_id']
                                }");
                        if ($deleteAulas->getResult()):
                            $deleteModulos->ExeDelete(MODULOS, "WHERE modulo_id = :id", "id={$modulo['modulo_id']
                                    }");
                        endif;
                    endif;
                else:
                    $deleteAulas->ExeDelete(AULAS, "WHERE aula_id = :id", "id={$aula['aula_id']
                            }");
                    if ($deleteAulas->getResult()):
                        $deleteModulos->ExeDelete(MODULOS, "WHERE modulo_id = :id", "id={$modulo['modulo_id']
                                }");
                    endif;
                endif;
            endforeach;
        else:
            $deleteModulos->ExeDelete(MODULOS, "WHERE modulo_id = :id", "id={$modulo['modulo_id']
                    }");
        endif;

    endforeach;




endif;

$deleteCursos = new adminCurso();
$deleteCursos->ExeDelete($Post['id']);
//        $jSon['error'] = $deleteCursos->getError();
//        var_dump($Post);
//        $jSon['error'] = $delete->getError();
