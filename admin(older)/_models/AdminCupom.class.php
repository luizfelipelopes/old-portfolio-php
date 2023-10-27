<?php

/**
 * AdminProduto.class [ MODEL ADMIN ]
 * Classe responsável por manipular e tratar os dados do cupom 
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class AdminCupom {

    private $Cupom;
    private $Data;
    private $Result;
    private $Error;

    const Entity = CUPONS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Preenche todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->tratarDados();
            $this->Result = true;
        endif;

        if ($this->Result):
            $this->Create();
        endif;
    }

    public function ExeUpdate($Id, array $Data) {

        $this->Cupom = (int) $Id;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Preenche todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->tratarDados();
            $this->Result = true;
        endif;

        if ($this->Result):
            $this->Update();
        endif;
    }

    public function ExeStatus($Id, $Status) {

        $this->Cupom = (int) $Id;
        $this->Data = $Status;

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE cupom_id = :id", "id={$this->Cupom}");
        if (!$read->getResult()):
            $this->Error = ["Índice inválido! Favor tente novamente", WS_ALERT];
            $this->Result = false;

        else:
            $update = new Update();
            $update->ExeUpdate(self::Entity, $this->Data, "WHERE cupom_id = :id", "id={$this->Cupom}");
            if (!$update->getResult()):
                $this->Error = ["Não foi possível atualizar o status do cupom <b> {$read->getResult()[0]['cupom_codigo']}</b> ! Favor tente novamente", WS_ALERT];
                $this->Result = false;
            else:
                $this->Error = ["Status do cupom <b> {$read->getResult()[0]['cupom_codigo']}</b> atualizado com sucesso !", WS_ACCEPT];
                $this->Result = true;
            endif;


        endif;
    }

    public function ExeDelete($Id) {
        $this->Cupom = (int) $Id;

        $delete = new Delete();
        //DELETA O CUPOM DO BANCO
        $delete->ExeDelete(self::Entity, "WHERE cupom_id = :id", "id={$this->Cupom}");

        if (!$delete->getResult()):
            $this->Error = ["Não foi possível deletar cupom <b> {$delete->getResult()[0]['cupom_codigo']}</b> ! Favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["Cupom deletado com sucesso!", WS_ACCEPT];
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

        $this->Data['cupom_desconto'] = Check::toFloat($this->Data['cupom_desconto'] / 100);

        if(empty($this->Cupom)):
            $this->Data['cupom_date'] = date('Y-m-d H:i:s');
        endif;

//        $this->Data['cupom_validade'] = date('Y-m-d H:i:s', strtotime($this->Data['cupom_validade']));
        $this->Data['cupom_author'] = $_SESSION['userlogin']['user_id'];

        if (empty($this->Data['cupom_status'])):
            $this->Data['cupom_status'] = '0';
        endif;
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar! Por favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["Cupom cadastrado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update();
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE cupom_id = :id", "id={$this->Cupom}");

        if (!$update->getResult()):
            $this->Error = ["Erro atualizar o cupom {$this->Data['cupom_codigo']}. Tente Novamente!", WS_ALERT];
            $this->Result = false;
        else:

            $this->Error = ["O cupom <b>{$this->Data['cupom_codigo']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

}
