<?php

/**
 * AdminEmail.class [ MODEL ADMIN ]
 * Classe responsável por manipular e tratar os dados do cupom 
 * 
 * @copyright (c) 2017, Luiz Felipe C. Lopes
 */
class AdminEmail {

    private $Email;
    private $Data;
    private $Result;
    private $Error;

    const Entity = EMAILS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;


        if (in_array('', $this->Data)):
            $this->Error = ["Preencha todos os campos", WS_ALERT];
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

        $this->Email = (int) $Id;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Preencha todos os campos", WS_ALERT];
            $this->Result = false;
        else:
            $this->tratarDados();
            $this->Result = true;
        endif;

        if ($this->Result):
            $this->Update();
        endif;
    }

    public function ExeDelete($Id) {
        $this->Email = (int) $Id;

        $delete = new Delete();
        //DELETA O CUPOM DO BANCO
        $delete->ExeDelete(self::Entity, "WHERE email_id = :id", "id={$this->Email}");

        if (!$delete->getResult()):
            $this->Error = ["Não foi possível deletar e-mail <b> {$delete->getResult()[0]['email_id']}</b> ! Favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["E-mail deletado com sucesso!", WS_ACCEPT];
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

        $Conteudo = $this->Data['email_content'];
        $Assinatura = $this->Data['email_assinatura'];
        unset($this->Data['email_content'], $this->Data['email_assinatura']);
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

//        $this->Data['email_desconto'] = Check::toFloat($this->Data['email_desconto'] / 100);

        $this->Data['email_content'] = $Conteudo;
        $this->Data['email_assinatura'] = $Assinatura;
        
        if (empty($this->Email)):
            $this->Data['email_date'] = date('Y-m-d H:i:s');
        endif;

//        $this->Data['email_validade'] = date('Y-m-d H:i:s', strtotime($this->Data['email_validade']));
        $this->Data['email_author'] = $_SESSION['userlogin']['user_id'];
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar! Por favor tente novamente", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["E-mail salvo com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update();
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE email_id = :id", "id={$this->Email}");

        if (!$update->getResult()):
            $this->Error = ["Erro atualizar o e-mail {$this->Data['email_id']}. Tente Novamente!", WS_ALERT];
            $this->Result = false;
        else:

            $this->Error = ["Email salvo com sucesso!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

}
