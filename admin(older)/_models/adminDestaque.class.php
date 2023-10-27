<?php

/**
 * adminDestaque.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Destaques
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminDestaque {

    private $Destaque;
    private $Data;
    private $Error;
    private $Result;

    const Entity = DESTAQUES;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;


        $url = $this->Data['destaque_url'];
        unset($this->Data['destaque_url']);

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
            $this->Data['destaque_url'] = $url;

            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagem();

            $this->Create();

        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Destaque = (int) $Id;
        $this->Data = $Dados;

        if (!empty($this->Data['destaque_url'])):
            $url = $this->Data['destaque_url'];
            unset($this->Data['destaque_url']);
        endif;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
            if (!empty($this->Data['destaque_url'])):
                $this->Data['destaque_url'] = $url;
            endif;
            $this->tratarDados();
            if (!empty($this->Data['destaque_title'])):
                $this->verificarNome();
            endif;

            if (!empty($this->Data['destaque_cover'])):
                $this->verificarImagemUpload();
            endif;

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Destaque = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

        if (!empty($this->Data['destaque_cover'])):
            $Imagem = $this->Data['destaque_cover'];
            unset($this->Data['destaque_cover']);
        endif;

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        if (!empty($this->Data['destaque_title'])):
            $this->Data['destaque_name'] = Check::Name($this->Data['destaque_title']);
        endif;

        if (!empty($Imagem)):
            $this->Data['destaque_cover'] = $Imagem;
        endif;

        if (!isset($this->Data['destaque_status'])):
            $this->Data['destaque_status'] = '0';
        endif;

        $Data = str_replace('/', '-', substr($this->Data['destaque_date'], 0, 10));
        $Hora = date('H:i:s', strtotime(substr($this->Data['destaque_date'], 10, 8)));
        $this->Data['destaque_date'] = date('Y-m-d H:i:s', strtotime($Data . ' ' . $Hora));
    }

    private function verificarNome() {

        $where = (!empty($this->Destaque) ? "destaque_id != {$this->Destaque} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} destaque_title = :title", "title={$this->Data['destaque_title']}");
        if ($read->getResult()):
            $this->Data['destaque_name'] = $this->Data['destaque_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function verificarImagem() {

        if (!empty($this->Data['destaque_cover']) && is_array($this->Data['destaque_cover'])):

            $upload = new Upload('../../uploads');
            $upload->Image($this->Data['destaque_cover'], $this->Data['destaque_name'], null, '/destaques');

            if (!$upload->getResult()):
                $this->Data['destaque_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['destaque_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['destaque_cover'] && is_array($this->Data['destaque_cover'])):

            $readCapa = new Read;
            $readCapa->ExeRead(DESTAQUES, "WHERE destaque_id = :id", "id={$this->Destaque}");
            if ($readCapa->getResult()):

                $capa = '../../uploads' . $readCapa->getResult()[0]['destaque_cover'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../uploads");
                $upload->Image($this->Data['destaque_cover'], $this->Data['destaque_name'], null, "/destaques");
                if (!$upload->getResult()):
                    unset($this->Data['destaque_cover']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['destaque_cover'] = $upload->getResult();
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
            $this->Error = ['Não foi possível cadastrar Destaque', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Destaque cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE destaque_id = :id", "id={$this->Destaque}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Destaque", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Destaque Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE destaque_id = :id", "id={$this->Destaque}");
        if ($read->getResult()):
            $capa = '../../uploads' . $read->getResult()[0]['destaque_cover'];

            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE destaque_id = :id", "id={$this->Destaque}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Destaque", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Destaque Excluído com Sucesso!", WS_ACCEPT];
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
