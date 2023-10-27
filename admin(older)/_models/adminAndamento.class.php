<?php

/**
 * adminAndamento [ _models ]
 * Descrição
 * @copyright (c) year, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class adminAndamento {

    private $Andamento;
    private $Data;
    private $Result;
    private $Error;

    const Entity = AULAS_ANDAMENTO;

    public function ExeCreate($Id, $Data) {

        
        $this->Data['andamento_aluno'] = (int)$Id;
        $this->Data['andamento_aula'] = (int)$Data;
        
        $this->tratarDados();
        $this->Create();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    private function tratarDados() {

        $this->Data['andamento_registro'] = date('Y-m-d H:i:s');

        $readAula = new Read;
        $readAula->ExeRead(AULAS, "WHERE aula_id = :aula", "aula={$this->Data['andamento_aula']}");
        if ($readAula->getResult()):
            $this->Data['andamento_modulo'] = (int)$readAula->getResult()[0]['aula_modulo'];

            $readModulo = new Read;
            $readModulo->ExeRead(MODULOS, "WHERE modulo_id = :modulo", "modulo={$this->Data['andamento_modulo']}");
            if ($readModulo->getResult()):
                $this->Data['andamento_curso'] = (int)$readModulo->getResult()[0]['modulo_curso'];
            endif;

        endif;
    }

    private function Create() {

        $create = new Create;
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar andamento do curso", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Andamento do curso cadastrado com sucesso!", WS_ACCEPT];
            $this->Result = $create->getResult();
        endif;
    }

}
