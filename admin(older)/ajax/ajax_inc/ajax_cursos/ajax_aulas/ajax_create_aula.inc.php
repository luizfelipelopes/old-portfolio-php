<?php

/**
 * ajax_create_aula.inc.php - <b>CREATE AULAS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Disciplinas do Módulo do Curso
 */
$tot_material = 0;
$id = $Post['aula_id'];
$aula_curso = $Post['aula_curso'];
$aula_modulo = $Post['aula_modulo'];
unset($Post['aula_id'], $Post['aula_curso']); // aula_id E aula_curso NÂO ENTRAM NA BASE BASE DE DADOS
// POR ISSO PRECISAM SER TIRADOS              

$meuArray = array();

//        CADASTRA AULAS

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

$adminAula = new adminAula;
$adminAula->ExeCreate($meuArray);

//        RECUPERA ID DA AULA CADASTRADA
$read = new Read;
$read->ExeRead(AULAS, "WHERE aula_title = :name", "name={$meuArray['aula_title']
        }");
if ($read->getResult()):
    $num = $read->getRowCount() - 1;
    $id = $read->getResult()[$num]['aula_id'];
endif;


//        SCRIPT PARA CADASTRAR ARQUIVOS DA AULA CADASTRADA

if (isset($_FILES['material_aula']['tmp_name'])): //VERIFICA SE TEM ALGUM UPLOAD DE ARQUIVOS
    $i = 0;
    $j = count($_FILES['material_aula']['tmp_name']);  // RECUPERA O NÙMERO DE ARQUIVOS QUE FOI FEITO UPLOAD
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



        $adminMaterial = new adminMaterial;
        $adminMaterial->ExeCreate($id, $File);
//                var_dump($adminMaterial);
        $tot_material++;
    endfor;

endif;

//        MENSAGEM PARA VERIFICAR SE AULA FOI CADASTRADA
$jSon['error'] = $adminAula->getError();


//        RECUPERA O CURSO DA AULA CADASTRADA
$readCurso = new Read;
$readCurso->ExeRead(CURSOS, "WHERE curso_id = :id", "id={$aula_curso
        }");
if ($readCurso->getResult()):
    extract($readCurso->getResult()[0]);
endif;

//        RECUPERA O MÒDULO DA HORA CADASTRADA
$readModulo = new Read;
$readModulo->ExeRead(MODULOS, "WHERE modulo_id = :id", "id={$aula_modulo
        }");
if ($readModulo->getResult()):
    extract($readModulo->getResult()[0]);
endif;

//        SCRIPT PARA RECUPERAR OS TEMPLATE DAS AULAS CADASTRADAS DO MÓDULO
$read = new Read;
$read->ExeRead(AULAS, "WHERE aula_modulo = :modulo ORDER BY aula_date ASC", "modulo={$modulo_id
        }");
if (!$read->getResult()):
//            $jSon['error'] = ["Nehum curso foi encontrado com esta pesquisa", "infor"];
else:


    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $i = 0;

    $View = new View();
    $tpl_aula = $View->Load('aula');

//            $readMateriais = new Read;
    foreach ($read->getResult() as $aula):
        extract($aula);

//                $readMateriais->ExeRead(MATERIAIS, "WHERE material_aula = :aula", "aula={$adminAula->getResult()}");


        $aula['total_material'] = $tot_material;
        $aula['modulo_id'] = $modulo_id;
        $aula['curso_id'] = $curso_id;
        $aula['aula_date'] = date('d/m/Y', strtotime($aula['aula_date']));

        $jSon['result'] += [$i => $View->returnView($aula, $tpl_aula)];

        $i++;
    endforeach;


        endif;
