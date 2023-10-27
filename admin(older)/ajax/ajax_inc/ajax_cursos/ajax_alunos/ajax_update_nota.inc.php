<?php

/**
 * ajax_update_nota.inc.php - <b>UPDATE NOTA ALUNO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização da Nota do Aluno
 */

$id = $Post['nota_id'];
        unset($Post['nota_id']);
        $jSon['id'] = $id;

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $adminNota = new adminNota;
        $adminNota->ExeUpdate($id, $meuArray);
        $jSon['error'] = $adminNota->getError();

        if ($adminNota->getResult()):
            $jSon['nota_total'] = $adminNota->getResult();
            $readNota = new Read;
            $readNota->ExeRead(NOTAS, "WHERE nota_id = :id", "id={$id}");

        endif;
        $jSon['nota_status'] = $readNota->getResult()[0]['nota_status'];


        if ($jSon['nota_status'] == 'Aprovado'):


            if (isset($Post['nota_aluno'])):
                $cliente_andamento = $Post['nota_aula'];

                $readAula = new Read;
                $readAula->ExeRead(AULAS, "WHERE aula_id = :aula", "aula={$cliente_andamento}");


                $readModulo = new Read;
                $readModulo->ExeRead(MODULOS, "WHERE modulo_id = :modulo", "modulo={$readAula->getResult()[0]['aula_modulo']}");

                $readCurso = new Read;
                $readCurso->ExeRead(CURSOS, "WHERE curso_id = :curso", "curso={$readModulo->getResult()[0]['modulo_curso']}");



//CALCULO DE PORCENTAGENS DE ANDAMENTO DO CURSO=======================================
//$readAndamentoAluno = new Read;
//$readAndamentoAluno->ExeRead(AULAS_ANDAMENTOS, "WHERE andamento_aula = :aula AND andamento_aluno = :aluno", "aula={$_SESSION['clientelogin']['cliente_andamento']}&aluno={$_SESSION['clientelogin']['cliente_id']}");
//if (!$readAndamentoAluno->getResult()):
//endif;
//                DIVISÂO DE PERCENTUAL DOS MODULOS
                $readModuloTotal = new Read;
                $readModuloTotal->ExeRead(MODULOS, "WHERE modulo_curso = :curso", "curso={$readCurso->getResult()[0]['curso_id']}");
                $TotalModulos = $readModuloTotal->getRowCount();
                $PercentualPorModulo = 0;
                if ($TotalModulos):
                    $PercentualPorModulo = 100 / $TotalModulos;
                endif;


//FOR EACH AULAS
                $readAulasTotal = new Read;
                $TotalAulas = array();

//                DIVISÃO DE PERCENTUAL DAS AULAS DE CADA MÒDULO
                foreach ($readModuloTotal->getResult() as $mod):
                    $readAulasTotal->ExeRead(AULAS, "WHERE aula_modulo = :modulo", "modulo={$mod['modulo_id']}");
                    $PercentualPorAula = $PercentualPorModulo / $readAulasTotal->getRowCount();
                    $TotalAulas += [$mod['modulo_id'] => $PercentualPorAula];
                endforeach;


//CALCULO DE PROGRESSO DO ALUNO=================================================
//                VERIFICA SE JÁ HOUVE PROGRESSO PELO ALUNO
                $readAndamento = new Read;
                $readAndamento->ExeRead(PROGRESSOS, "WHERE progresso_aluno = :id AND progresso_curso = :curso", "id={$Post['nota_aluno']}&curso={$readCurso->getResult()[0]['curso_id']}");
//var_dump($readAndamento->getResult()[0]['progresso_andamento']);
                $alunoAndamento = ($readAndamento->getResult()[0]['progresso_andamento'] ? $readAndamento->getResult()[0]['progresso_andamento'] : 0);
//var_dump($alunoAndamento);
//var_dump($TotalModulos, $PercentualPorModulo);
//var_dump($TotalAulas[$readModulo->getResult()[0]['modulo_id']]);
//                VERIFICA SE CONCLUI ALGUMA AULA(CASO NÂO TENHA CONCLUÍDO, CRIA UM NOVO ANDAMENTO E ATUALIZA PROGRESSO, CASO JÁ CONCLUIU, APENAS ATUALIZA A AULA QUE ELE PAROU)
                $readAulasConcluidas = new Read;
                $readAulasConcluidas->ExeRead(AULAS_ANDAMENTOS, "WHERE andamento_aula = :aula AND andamento_aluno = :aluno", "aula={$Post['nota_aula']}&aluno={$Post['nota_aluno']}");
                if (!$readAulasConcluidas->getResult()):

                    $adminAndamento = new adminAndamento;
                    $adminAndamento->ExeCreate($Post['nota_aluno'], $cliente_andamento);
//    var_dump($adminAndamento);

                    $alunoAndamento += $TotalAulas[$readModulo->getResult()[0]['modulo_id']];

                    $updateAndamento = new Update;

                    $DataAndamento = [
                        "progresso_aula" => $meuArray['nota_aula'],
                        "progresso_andamento" => $alunoAndamento
                    ];


                    $updateAndamento->ExeUpdate(PROGRESSOS, $DataAndamento, "WHERE progresso_aluno = :id AND progresso_curso = :curso", "id={$Post['nota_aluno']}&curso={$readCurso->getResult()[0]['curso_id']}");
                else:

                    $DataAula = ["progresso_aula" => $meuArray['nota_aula']];
                    $updateAula = new Update;
                    $updateAula->ExeUpdate(PROGRESSOS, $DataAula, "WHERE progresso_aluno = :id AND progresso_curso = :curso", "id={$Post['nota_aluno']}&curso={$readCurso->getResult()[0]['curso_id']}");

                endif;


//var_dump($alunoAndamento);
//CALCULO DE PROGRESSO DO ALUNO=================================================
            endif;


        endif;
