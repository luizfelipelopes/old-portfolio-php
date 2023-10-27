<?php

/**
 * adminPagina.class [ ADMIN ]
 * Classe Responsável pela Gestão dos Paginas
 * @copyright (c) 2017, Luiz Felipe C. Lopes 
 */
class adminPagina {

    private $Pagina;
    private $Data;
    private $Error;
    private $Result;

    const Entity = PAGINAS;

    public function ExeCreate(array $Data) {

        $this->Data = $Data;


//        $url = $this->Data['pagina_url'];
//        unset($this->Data['pagina_url']);

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
//            $this->Data['pagina_url'] = $url;

            $this->tratarDados();
            $this->verificarNome();
            $this->verificarImagem();

            $this->Create();

        endif;
    }

    public function ExeUpdate($Id, array $Dados) {

        $this->Pagina = (int) $Id;
        $this->Data = $Dados;

//        if (!empty($this->Data['pagina_url'])):
//            $url = $this->Data['pagina_url'];
//            unset($this->Data['pagina_url']);
//        endif;

        if (in_array('', $this->Data)):
            $this->Error = ["Por favor, preencha todos os dados", WS_ALERT];
            $this->Result = false;

        else:
//            if (!empty($this->Data['pagina_url'])):
//                $this->Data['pagina_url'] = $url;
//            endif;
            $this->tratarDados();
            if (!empty($this->Data['pagina_title'])):
                $this->verificarNome();
            endif;

            if (!empty($this->Data['pagina_cover'])):
                $this->verificarImagemUpload();
            endif;

            $this->Update();

        endif;
    }

    public function ExeDelete($Id) {
        $this->Pagina = (int) $Id;
        $this->Delete();
    }

    private function tratarDados() {

        if (!empty($this->Data['pagina_cover'])):
            $Imagem = $this->Data['pagina_cover'];
            unset($this->Data['pagina_cover']);
        elseif (isset($this->Pagina) && !isset($this->Data['pagina_cover'])):
            $this->Data['pagina_cover'] = null;
        endif;

        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);

        if (!empty($this->Data['pagina_title'])):
            $this->Data['pagina_name'] = (!empty($this->Data['pagina_name']) ? Check::Name($this->Data['pagina_name']) : Check::Name($this->Data['pagina_title']));
        endif;

        if (!empty($Imagem)):
            $this->Data['pagina_cover'] = $Imagem;
        endif;

        if (!isset($this->Data['pagina_status'])):
            $this->Data['pagina_status'] = '0';
        endif;

        if (!empty($this->Data['pagina_date'])):
            $Data = str_replace('/', '-', substr($this->Data['pagina_date'], 0, 10));
            $Hora = date('H:i:s', strtotime(substr($this->Data['pagina_date'], 10, 8)));
            $this->Data['pagina_date'] = date('Y-m-d H:i:s', strtotime($Data . ' ' . $Hora));
        endif;
    }

    private function verificarNome() {

        $where = (!empty($this->Pagina) ? "pagina_id != {$this->Pagina} AND " : '');

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE {$where} pagina_title = :title", "title={$this->Data['pagina_title']}");
        if ($read->getResult()):
            $this->Data['pagina_name'] = $this->Data['pagina_name'] . '-' . ($read->getRowCount() + 1);
        endif;
    }

    private function verificarImagem() {

        if (!empty($this->Data['pagina_cover']) && is_array($this->Data['pagina_cover'])):

            $upload = new Upload('../../uploads');
            $upload->Image($this->Data['pagina_cover'], $this->Data['pagina_name'], null, '/paginas');

            if (!$upload->getResult()):
                $this->Data['pagina_cover'] = null;
                $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                $this->Result = false;
            else:
                $this->Data['pagina_cover'] = $upload->getResult();
                $this->Result = true;
            endif;

        endif;
    }

    private function verificarImagemUpload() {

        if ($this->Data['pagina_cover'] && is_array($this->Data['pagina_cover'])):

            $readCapa = new Read;
            $readCapa->ExeRead(PAGINAS, "WHERE pagina_id = :id", "id={$this->Pagina}");
            if ($readCapa->getResult()):

                $capa = '../../uploads' . $readCapa->getResult()[0]['pagina_cover'];

                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $upload = new Upload("../../uploads");
                $upload->Image($this->Data['pagina_cover'], $this->Data['pagina_name'], null, "/paginas");
                if (!$upload->getResult()):
                    unset($this->Data['pagina_cover']);
                    $this->Error = [$upload->getError()[0], $upload->getError()[1]];
                    $this->Result = false;
                else:
                    $this->Data['pagina_cover'] = $upload->getResult();
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
            $this->Error = ['Não foi possível cadastrar Pagina', WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ['Pagina cadastrado com Sucesso!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update;
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE pagina_id = :id", "id={$this->Pagina}");
        if (!$update->getResult()):
            $this->Error = ["Erro ao Atualizar Pagina", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Pagina Atualizado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Delete() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE pagina_id = :id", "id={$this->Pagina}");
        if ($read->getResult()):
            $capa = '../../uploads' . $read->getResult()[0]['pagina_cover'];

            if (file_exists($capa) && !is_dir($capa)):
                unlink($capa);
            endif;
        endif;

        $delete = new Delete;
        $delete->ExeDelete(self::Entity, "WHERE pagina_id = :id", "id={$this->Pagina}");
        if (!$delete->getResult()):
            $this->Error = ["Erro ao Excluir Pagina", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Pagina Excluído com Sucesso!", WS_ACCEPT];
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
