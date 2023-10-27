<?php

/**
 * adminVideo.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Videos
 * @copyright (c) 2016, Luiz Felipe C. Lopes 
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
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:

            $this->tratarDados();
            $this->verificarNome();

//            if ($this->getResult()):
            $this->Create();
//            endif;
        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Video = (int) $Id;
        $this->Data = $Dados;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
            $this->tratarDados();

            if (!empty($this->Data['video_title'])):
                $this->verificarNome();
            endif;

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Video = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

//        $Content = $this->Data['video_content'];

        if (!empty($this->Data['video_url'])):
            $Url = $this->Data['video_url'];
            unset($this->Data['video_url']);
        endif;

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);


        if (!empty($this->Data['video_title'])):
            $this->Data['video_name'] = Check::Name($this->Data['video_title']);
        endif;

        if (!empty($Url)):
            $this->Data['video_url'] = $Url;
        endif;


        if (!isset($this->Data['video_status'])):
            $this->Data['video_status'] = '0';
        endif;

        if (!isset($this->Data['video_destaque'])):
            $this->Data['video_destaque'] = '0';
        endif;

        if (isset($this->Data['video_date'])):
            $Data = str_replace('/', '-', substr($this->Data['video_date'], 0, 10));
            $Hora = date('H:i:s', strtotime(substr($this->Data['video_date'], 10, 8)));
            $this->Data['video_date'] = date('Y-m-d H:i:s', strtotime($Data . ' ' . $Hora));
        endif;
    }

    private function verificarNome() {

        $where = (!empty($this->Video) ? "video_id != {$this->Video} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} video_title = :title", "title={$this->Data['video_title']}");
        if ($read->getResult()):
            $this->Data['video_name'] = $this->Data['video_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ['Não foi possível cadastrar Video', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Video cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {
        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE video_id = :id", "id={$this->Video}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Video", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Video Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE video_id = :id", "id={$this->Video}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Video", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Video Excluído com Sucesso!", WS_ACCEPT];
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
