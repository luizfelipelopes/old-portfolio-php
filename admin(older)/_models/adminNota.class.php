<?php

/**
 * adminNota.class [ ADMIN ]
 * Classe Responsável pela Gestão das Notas
 * @copyright (c) 2016, Luiz Felipe C. Lopes 
 */
class adminNota {

    private $Nota;
    private $Data;
    private $Error;
    private $Result;

    const Entity = NOTAS;

    public function ExeCreate($aluno, $aula, array $Data = null) {

        if (isset($Data)):
            $this->Data = $Data;
        endif;

        $this->Data['nota_aluno'] = (int) $aluno;
        $this->Data['nota_aula'] = (int) $aula;

        $this->tratarDados();

        $this->Create();
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Nota = (int) $Id;
        $this->Data = $Dados;

        $this->tratarDados();

        $this->Update();
    }

    private function tratarDados() {

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        $this->Data['nota_total'] = 0;

        if (isset($this->Data['nota_1']) && $this->Data['nota_1'] != null):
            $this->Data['nota_1'] = Check::toFloat($this->Data['nota_1']);
            $this->Data['nota_total'] += $this->Data['nota_1'];
        else:
            unset($this->Data['nota_1']);
        endif;

        if (isset($this->Data['nota_2']) && $this->Data['nota_2'] != null):
            $this->Data['nota_2'] = Check::toFloat($this->Data['nota_2']);
            $this->Data['nota_total'] += $this->Data['nota_2'];
            else:
            unset($this->Data['nota_2']);
        endif;

        if (isset($this->Data['nota_3']) && $this->Data['nota_3'] != null):
            $this->Data['nota_3'] = Check::toFloat($this->Data['nota_3']);
            $this->Data['nota_total'] += $this->Data['nota_3'];
            else:
            unset($this->Data['nota_3']);
        endif;

        if (isset($this->Data['nota_4']) && $this->Data['nota_4'] != null):
            $this->Data['nota_4'] = Check::toFloat($this->Data['nota_4']);
            $this->Data['nota_total'] += $this->Data['nota_4'];
            else:
            unset($this->Data['nota_4']);
        endif;

        if (isset($this->Data['nota_5']) && $this->Data['nota_5'] != null):
            $this->Data['nota_5'] = Check::toFloat($this->Data['nota_5']);
            $this->Data['nota_total'] += $this->Data['nota_5'];
            else:
            unset($this->Data['nota_5']);
        endif;

        if (isset($this->Data['nota_1']) && isset($this->Data['nota_2']) && isset($this->Data['nota_3']) && isset($this->Data['nota_4']) && isset($this->Data['nota_5'])):

            if ($this->Data['nota_total'] < 70):
                $this->Data['nota_status'] = 'Recuperação';
            else:
                $this->Data['nota_status'] = 'Aprovado';
            endif;
            
            else:
                $this->Data['nota_status'] = '-';
        endif;



        $this->Data['nota_registro'] = date('Y-m-d H:i:s');
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Nota', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Nota cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE nota_id = :id", "id={$this->Nota}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Nota", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Nota Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = $this->Data['nota_total'];
        endif;
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

}
