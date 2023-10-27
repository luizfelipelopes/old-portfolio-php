<?php

/**
 * adminProgresso [ _models ]
 * Descrição
 * @copyright (c) year, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class adminProgresso {

    private $Progresso;
    private $Data;
    private $Result;
    private $Error;

    const Entity = PROGRESSOS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;
        $this->Create();
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    private function Create() {

        $create = new Create;
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar progresso do curso", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Progresso do curso cadastrado com sucesso!", WS_ACCEPT];
            $this->Result = $create->getResult();
        endif;
    }

}
