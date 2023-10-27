<?php

/**
 * adminAnuncio.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Anuncios
 * @copyright (c) 2016, Luiz Felipe C. Lopes 
 */
class adminAnuncio {

    private $Anuncio;
    private $Data;
    private $Error;
    private $Result;

    const Entity = ANUNCIOS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;


        $url = $this->Data['anuncio_url'];
        unset($this->Data['anuncio_url']);

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
            $this->Data['anuncio_url'] = $url;

            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagem();

            $this->Create();

        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Anuncio = (int) $Id;
        $this->Data = $Dados;

        if (!empty($this->Data['anuncio_url'])):
            $url = $this->Data['anuncio_url'];
            unset($this->Data['anuncio_url']);
        endif;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
            if (!empty($this->Data['anuncio_url'])):
                $this->Data['anuncio_url'] = $url;
            endif;
            $this->tratarDados();
            if (!empty($this->Data['anuncio_title'])):
                $this->verificarNome();
            endif;

            if (!empty($this->Data['anuncio_cover'])):
                $this->verificarImagemUpload();
            endif;

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Anuncio = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

        if (!empty($this->Data['anuncio_cover'])):
            $Imagem = $this->Data['anuncio_cover'];
            unset($this->Data['anuncio_cover']);
        endif;

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        if (!empty($this->Data['anuncio_title'])):
            $this->Data['anuncio_name'] = Check::Name($this->Data['anuncio_title']);
        endif;

        if (!empty($Imagem)):
            $this->Data['anuncio_cover'] = $Imagem;
        endif;

        if (!isset($this->Data['anuncio_status'])):
            $this->Data['anuncio_status'] = '0';
        endif;

        if (isset($this->Data['anuncio_date'])):
            $Data = str_replace('/', '-', substr($this->Data['anuncio_date'], 0, 10));
            $Hora = date('H:i:s', strtotime(substr($this->Data['anuncio_date'], 10, 8)));
            $this->Data['anuncio_date'] = date('Y-m-d H:i:s', strtotime($Data . ' ' . $Hora));
        endif;
    }

    private function verificarNome() {

        $where = (!empty($this->Anuncio) ? "anuncio_id != {$this->Anuncio} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} anuncio_title = :title", "title={$this->Data['anuncio_title']}");
        if ($read->getResult()):
            $this->Data['anuncio_name'] = $this->Data['anuncio_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function verificarImagem() {

        if (!empty($this->Data['anuncio_cover']) && is_array($this->Data['anuncio_cover'])):

            $upload = new Upload('../../uploads');
            $upload->Image($this->Data['anuncio_cover'], $this->Data['anuncio_name'], null, '/anuncios');

            if (!$upload->getResult()):
                $this->Data['anuncio_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['anuncio_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['anuncio_cover'] && is_array($this->Data['anuncio_cover'])):

            $readCapa = new Read;
            $readCapa->ExeRead(ANUNCIOS, "WHERE anuncio_id = :id", "id={$this->Anuncio}");
            if ($readCapa->getResult()):

                $capa = '../../uploads' . $readCapa->getResult()[0]['anuncio_cover'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../uploads");
                $upload->Image($this->Data['anuncio_cover'], $this->Data['anuncio_name'], null, "/anuncios");
                if (!$upload->getResult()):
                    unset($this->Data['anuncio_cover']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['anuncio_cover'] = $upload->getResult();
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
            $this->Error = ['Não foi possível cadastrar Anuncio', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Anuncio cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE anuncio_id = :id", "id={$this->Anuncio}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Anuncio", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Anuncio Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE anuncio_id = :id", "id={$this->Anuncio}");
        if ($read->getResult()):
            $capa = '../../uploads' . $read->getResult()[0]['anuncio_cover'];

            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE anuncio_id = :id", "id={$this->Anuncio}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Anuncio", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Anuncio Excluído com Sucesso!", WS_ACCEPT];
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
