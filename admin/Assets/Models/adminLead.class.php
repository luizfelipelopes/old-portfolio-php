<?php

/**
 * adminLead.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Leads
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminLead {

    private $Lead;
    private $Data;
    private $Error;
    private $Result;

    const Entity = LEADS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", "alert"];
            $this->Result = false;

        else:

            $this->tratarDados();
            $this->Create();

        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Lead = (int) $Id;
        $this->Data = $Dados;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", "alert"];
            $this->Result = false;

        else:

            $this->tratarDados();
            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Lead = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        $this->Data['lead_name'] = (!empty($this->Data['FNAME']) ? $this->Data['FNAME'] : $this->Data['lead_name']);
        $this->Data['lead_email'] = (!empty($this->Data['EMAIL']) ? $this->Data['EMAIL'] : $this->Data['lead_email']);

        if (!empty($this->Data['EMAIL'])):
            unset($this->Data['FNAME']);
            unset($this->Data['EMAIL']);
        endif;


        $this->Data['lead_date'] = date('Y-m-d H:i:s');
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Lead', "error"];
            $this->Result = false;
        else:
            $this->Error = ['Lead cadastrado com Sucesso!', "success"];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE lead_id = :id", "id={$this->Lead}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Lead", "error"];
            $this->Result = false;
        else:
            $this->Error = ["Lead Atualizado com Sucesso!", "success"];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE lead_id = :id", "id={$this->Lead}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Lead", "error"];
            $this->Result = false;
        else:
            $this->Error = ["Lead Excluído com Sucesso!", "success"];
            $this->Result = true;
        endif;
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

}
