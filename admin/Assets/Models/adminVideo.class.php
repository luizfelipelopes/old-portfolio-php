<?php

/**
 * adminVideo.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Videos
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminVideo {

    private $Video;
    private $Data;
    private $Error;
    private $Result;

    const Entity = VIDEOS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", 'alert'];
            $this->Result = false;

        else:
            $this->tratarDados();
            $this->Create();
        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Video = (int) $Id;
        $this->Data = $Dados;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", 'alert'];
            $this->Result = false;

        else:
            $this->tratarDados();
            $this->Update();
        endif;
    }

    public function ExeDelete($Id) {
        $this->Video = (int) $Id;
        $this->Delete();
    }

    public function ExeStatus($Id, $Dados) {
        $this->Video = (int) $Id;
        $this->Data = $Dados;
        $this->Update();
    }

    private function tratarDados() {

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);


        
        if (!isset($this->Data['video_url'])):
            $this->Data['video_url'] = null;
        endif;

        if (!isset($this->Data['video_status'])):
            $this->Data['video_status'] = '0';
        endif;
        
        $this->Data['video_name'] = Check::Name($this->Data['video_title']);
        $this->Data['video_author'] = (!empty($_SESSION['userlogin']['user_id']) ? $_SESSION['userlogin']['user_id'] : '1');
        $this->Data['video_date'] = date('Y-m-d H:i:s');
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Video', 'error'];
            $this->Result = false;
        else:
            $this->Error = ['Video cadastrado com Sucesso!', 'success'];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE video_id = :id", "id={$this->Video}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Video", 'error'];
            $this->Result = false;
        else:
            $this->Error = ["Video Atualizado com Sucesso!", 'success'];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE video_id = :id", "id={$this->Video}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Video", 'error'];
            $this->Result = false;
        else:
            $this->Error = ["Video Excluído com Sucesso!", 'success'];
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
