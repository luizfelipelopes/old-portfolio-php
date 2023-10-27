<?php

/**
 * adminDepoimento.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Depoimentos
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminDepoimento {

    private $Depoimento;
    private $Data;
    private $Error;
    private $Result;

    const Entity = DEPOIMENTOS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", 'alert'];
            $this->Result = false;

        else:

            $this->tratarDados();

            if (!empty($this->Data['depoimento_cover'])):
                $this->verificarImagem();
            endif;

            $this->Create();

        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Depoimento = (int) $Id;
        $this->Data = $Dados;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", 'alert'];
            $this->Result = false;

        else:

            $this->tratarDados();

            if (!empty($this->Data['depoimento_cover'])):
                $this->verificarImagemUpload();
            endif;

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Depoimento = (int) $Id;
        $this->Delete();
    }

    public function ExeStatus($Id, $Dados) {
        $this->Depoimento = (int) $Id;
        $this->Data = $Dados;
        $this->Update();
    }

    private function tratarDados() {

        if (!empty($this->Data['depoimento_cover'])):
            $Imagem = $this->Data['depoimento_cover'];
            unset($this->Data['depoimento_cover']);
        endif;

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);


        if (!isset($this->Data['depoimento_video'])):
            $this->Data['depoimento_video'] = null;
        endif;

        if (!empty($Imagem)):
            $this->Data['depoimento_cover'] = $Imagem;
        else:
            $this->Data['depoimento_cover'] = null;
        endif;

        if (!isset($this->Data['depoimento_status'])):
            $this->Data['depoimento_status'] = '0';
        endif;

        $this->Data['depoimento_author'] = (!empty($_SESSION['userlogin']['user_id']) ? $_SESSION['userlogin']['user_id'] : '1');
        $this->Data['depoimento_date'] = date('Y-m-d H:i:s');
    }

    private function verificarImagem() {

        if (!empty($this->Data['depoimento_cover']) && is_array($this->Data['depoimento_cover'])):

            $upload = new Upload('../../../uploads');
            $upload->Image($this->Data['depoimento_cover'], Check::Name($this->Data['depoimento_name']), 300000, '/depoimentos');

            if (!$upload->getResult()):
                $this->Data['depoimento_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['depoimento_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['depoimento_cover'] && is_array($this->Data['depoimento_cover'])):

            $readCapa = new Read;
            $readCapa->ExeRead(DEPOIMENTOS, "WHERE depoimento_id = :id", "id={$this->Depoimento}");
            if ($readCapa->getResult()):

                $capa = '../../../uploads' . $readCapa->getResult()[0]['depoimento_cover'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../../uploads");
                $upload->Image($this->Data['depoimento_cover'], Check::Name($this->Data['depoimento_name']), 300000, "/depoimentos");
                if (!$upload->getResult()):
                    unset($this->Data['depoimento_cover']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['depoimento_cover'] = $upload->getResult();
                    $this->Result = true;
                endif;

            endif;

        else:
            $this->Result = true;
        endif;
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Depoimento', 'error'];
            $this->Result = false;
        else:
            $this->Error = ['Depoimento cadastrado com Sucesso!', 'success'];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE depoimento_id = :id", "id={$this->Depoimento}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Depoimento", 'error'];
            $this->Result = false;
        else:
            $this->Error = ["Depoimento Atualizado com Sucesso!", 'success'];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE depoimento_id = :id", "id={$this->Depoimento}");
        if ($read->getResult()):
            $capa = '../../uploads' . $read->getResult()[0]['depoimento_cover'];

            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE depoimento_id = :id", "id={$this->Depoimento}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Depoimento", 'error'];
            $this->Result = false;
        else:
            $this->Error = ["Depoimento Excluído com Sucesso!", 'success'];
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
