<?php

/**
 * adminUser.class [ ADMIN ]
 * Classe Responsável pela Gestão das Users
 * @copyright (c) 2016, Luiz Felipe C. Lopes 
 */
class adminUser {

    private $User;
    private $Data;
    private $Error;
    private $Result;

    const Entity = USUARIOS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if ($this->Data['user_name'] == null || $this->Data['user_lastname'] == null || $this->Data['user_email'] == null || $this->Data['user_password'] == null || $this->Data['user_level'] == null):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        elseif (!Check::Email($this->Data['user_email'])):
            $this->Error = ["Formato de E-mail Inválido", WS_ERROR];
            $this->Result = false;

        else:
            $this->tratarDados();
            $this->verificarImagem();
            $this->verificarEmail();

            if ($this->getResult()):
                $this->Create();
            endif;
        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->User = (int) $Id;
        $this->Data = $Dados;

        if ($this->Data['user_name'] == null || $this->Data['user_lastname'] == null || $this->Data['user_email'] == null || $this->Data['user_password'] == null || $this->Data['user_level'] == null):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        elseif (!Check::Email($this->Data['user_email'])):
            $this->Error = ["Formato de E-mail Inválido", WS_ERROR];
            $this->Result = false;

        else:
//            $this->capturarCatParent();
            $this->tratarDados();
            $this->verificarImagemUpload();
            $this->verificarEmail();


            if ($this->Result):
                $this->Update();
            endif;

        endif;
    }

    public function ExeDelete($Id) {
        $this->User = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

        $Imagem = $this->Data['user_foto'];

        unset($this->Data['user_foto']);

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        $this->Data['user_foto'] = $Imagem;

        if (!isset($this->User)):
            $this->Data['user_password'] = substr(md5($this->Data['user_password']), 0, 16);
        else:
//            var_dump($this->verificarSenhaAlterada());
            if ($this->verificarSenhaAlterada()):
                $this->Data['user_password'] = substr(md5($this->Data['user_password']), 0, 16);
            else:
                unset($this->Data['user_password']);
            endif;
        endif;

        $this->Data['user_registration'] = date('Y-m-d H:i:s');
    }

    private function verificarSenhaAlterada() {

        $readUser = new Read;
        $readUser->ExeRead(self::Entity, "WHERE user_id = :id", "id={$this->User}");
        if ($readUser->getResult()):
            
//            var_dump($readUser->getResult()[0]['user_password'], substr(md5($this->Data['user_password']), 0, 16), $this->Data['user_password']);
            
            if ($readUser->getResult()[0]['user_password'] == $this->Data['user_password']):
                return false;
            elseif ($readUser->getResult()[0]['user_password'] != substr(md5($this->Data['user_password']), 0, 16)):
                return true;
            endif;
            
        endif;

        return false;
    }

    private function verificarEmail() {

        $where = ($this->User ? "AND user_id != {$this->User}" : '');

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE user_email = :email {$where}", "email={$this->Data['user_email']}");
        if ($read->getResult()):
            $this->Error = ["Este email já existe! Favor colocar outro.", WS_ALERT];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    private function verificarImagem() {

        if ($this->Data['user_foto'] && is_array($this->Data['user_foto'])):

            $upload = new Upload('../../uploads');
            $upload->Image($this->Data['user_foto'], Check::Name($this->Data['user_name']), null, '/usuarios');

            if (!$upload->getResult()):
                $this->Data['user_foto'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['user_foto'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['user_foto'] && is_array($this->Data['user_foto'])) {

            $readCapa = new Read;
            $readCapa->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$this->User}");
            if ($readCapa->getResult()):

                $capa = '../../uploads' . $readCapa->getResult()[0]['user_foto'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../uploads");
                $upload->Image($this->Data['user_foto'], Check::Name($this->Data['user_name']), null, "/usuarios");
                if (!$upload->getResult()):
                    unset($this->Data['user_foto']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['user_foto'] = $upload->getResult();
                    $this->Result = true;
                endif;



            endif;
        }
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar User', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['User cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE user_id = :id", "id={$this->User}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar User", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["User Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE user_id = :id", "id={$this->User}");
        if ($read->getResult()):
            $capa = '../../uploads' . $read->getResult()[0]['user_foto'];

            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE user_id = :id", "id={$this->User}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir User", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["User Excluído com Sucesso!", WS_ACCEPT];
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
