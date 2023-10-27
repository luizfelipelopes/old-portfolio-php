<?php

/**
 * AdminConfig.class [ MODEL ADMIN ]
 * Classe responsável por manipular e tratar os dados do cupom 
 * 
 * @copyright (c) 2017, Luiz Felipe C. Lopes
 */
class AdminConfig {

    private $Config;
    private $Data;
    private $Result;
    private $Error;

    const Entity = CONFIGURACOES;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;


        $this->tratarDados();
        $this->Result = true;

        if ($this->Result):
            $this->Create();
        endif;
    }

    public function ExeUpdate($Id, array $Data) {

        $this->Config = (int) $Id;
        $this->Data = $Data;

        $this->tratarDados();
        $this->Result = true;

        if ($this->Result):
            $this->Update();
        endif;
    }

    public function ExeDelete($Id) {
        $this->Config = (int) $Id;

        $delete = new Delete();
        //DELETA O CUPOM DO BANCO
        $delete->ExeDelete(self::Entity, "WHERE config_id = :id", "id={$this->Config}");

        if (!$delete->getResult()):
            $this->Error = ["Não foi possível deletar config <b> {$delete->getResult()[0]['config_id']}</b> ! Favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["Config deletado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    private function tratarDados() {

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['config_frete'] = Check::toFloat($this->Data['config_frete']);

        if (empty($this->Config)):
            $this->Data['config_date'] = date('Y-m-d H:i:s');
        endif;

//        $this->Data['config_validade'] = date('Y-m-d H:i:s', strtotime($this->Data['config_validade']));
        $this->Data['config_author'] = $_SESSION['userlogin']['user_id'];
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar! Por favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["Configurações salvas com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update();
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE config_id = :id", "id={$this->Config}");

        if (!$update->getResult()):
            $this->Error = ["Erro atualizar o cupom {$this->Data['config_codigo']}. Tente Novamente!", WS_ALERT];
            $this->Result = false;
        else:

            $this->Error = ["Configurações salvas com sucesso com sucesso!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

}
